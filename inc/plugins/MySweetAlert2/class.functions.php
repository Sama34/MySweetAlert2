<?php

/**
 * MySweetAlert2 Plugin (MySweetAlert2/class.functions.php)
 * 
 * This class contains all the functions needed to operate.
 *
 * @package MySweetAlert2
 * @author Skryptec <skryptec@gmail.com>
 */ 

class Functions {
    /**
     * Stores matched Javascript files.
     * @var array
     */
    private $jscripts;
    
    /**
     * Get all Javascript files in the jscripts directory.
     * 
     * @author Skryptec <skryptec@gmail.com>
     */
    public function getFiles() {
        $matched = [];

        foreach(glob('../../jscripts/*.js') as $jscript) {
            (strpos(file_get_contents($jscript), '$.jGrowl(') !== false) ? array_push($matched, $jscript) : null;
        }

        if(count($matched) > 0) {
            $this->jscripts = $matched;

            return true;
        }

        return false;
    }

    /**
     * Replace all lines containing jGrowl with SweetAlert's code.
     * 
     * @author Skryptec <skryptec@gmail.com>
     */
    public function replaceFilesWithSwal() {
        foreach($this->jscripts as $jscript) {
            file_put_contents($jscript, implode('', 
                array_map(function($data) {
                    $match = stristr($data, '$.jGrowl'); 

                    if($match) {
                        $filtered = explode(', ', trim(
                                        str_replace(
                                        [
                                            "{theme:'jgrowl_", 
                                            "'});", 
                                            '$.jGrowl('
                                        ], '', $match)
                                    ));
                        
                        $title = ucfirst($filtered[1]) . '!';

                        $swal = <<<EOL
                            /** MySweetAlert2 */
                            Swal.fire('$title', $filtered[0], '$filtered[1]');\n
                        EOL;

                        return $swal;
                    }

                    return $data;
                }, file($jscript))
            ));
        }
    }

    /**
     * Creates a backup of all matched Javascript files.
     * 
     * @author Skryptec <skryptec@gmail.com>
     */
    public function createBackupForRevert() {
        mkdir('../../jscripts/mysweetalert2_backup');

        foreach($this->jscripts as $jscript) {
            copy($jscript, substr_replace($jscript, 'mysweetalert2_backup/', 15, 0));
        }
    }

    public function revertSwal() {

    }
}