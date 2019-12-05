<?php

class View
{
    private $_file;
    private $_t;
    private $_style;

    public function __construct($action)
    {
        $this->_file = 'views/view'.$action.'.php';
    }

    // Génére & affiche la vue
    public function generate($data)
    {
        $content = $this->generateFile($this->_file, $data);
    
        // Template
        $view = $this->generateFile('views/template.php', array('t' => $this->_t, 'style' => $this->_style, 'content' => $content));

        echo $view;
    }

    // Génére un fichier vue et renvoi le résultat
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data); 

            ob_start();

            require $file;

            return ob_get_clean();
        }
        else
        {
            throw new Exception('Fichier '.$file. ' introuvable');
        }
    }
}

?>