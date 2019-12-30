<?php



class View
{
    private $_file;
    private $_t;
    private $_style;
    private $_template;

    public function __construct($action, $template)
    {
        $this->_file = 'views/view'.$action.'.php';
        $this->_template = $template;
    }

    // Génére & affiche la vue
    public function generate($data)
    {
        $content = $this->generateFile($this->_file, $data);
    
        // Template
        if($this->_template == 0)
        {
            $view = $this->generateFile('views/templates/template.php', array('t' => $this->_t, 'style' => $this->_style, 'content' => $content));
        }
        else if ($this->_template == 1)
        {
            $view = $this->generateFile('views/templates/templatePanel.php', array('t' => $this->_t, 'style' => $this->_style, 'content' => $content));
        }
        else
        {
            throw new Exception('Page introuvable !');
        }


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