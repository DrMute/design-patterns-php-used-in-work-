<?php
interface poly_writer_Writer {
    public function write(poly_base_Article $obj);
}


class poly_writer_XMLWriter implements poly_writer_Writer {
    public function write(poly_base_Article $obj) {
        $ret = '<article>';
        $ret .= '<title>' . $obj->title . '</title>';
        $ret .= '<author>' . $obj->author . '</author>';
        $ret .= '<date>' . $obj->date . '</date>';
        $ret .= '<category>' . $obj->category . '</category>';
        $ret .= '</article>';
        return $ret;
    }
}


class poly_writer_JSONWriter implements poly_writer_Writer {
    public function write(poly_base_Article $obj) {
        $array = array('article' => $obj);
        return json_encode($array);
    }
}

class poly_base_Article {
        public $title;
    public $author;
    public $date;
    public $category;
 
    public function  __construct($title, $author, $date, $category = 0) {
        $this->title = $title;
        $this->author = $author;
        $this->date = $date;
        $this->category = $category;
    }
    public function write(poly_writer_Writer $writer) {
        return $writer->write($this);
    }
}

class poly_base_Factory {
    public static function getWriter($format) {
        // grab request variable
       
        // construct our class name and check its existence
        $class = 'poly_writer_' . $format . 'Writer';
        if(class_exists($class)) {
            // return a new Writer object
            return new $class();
        }
        // otherwise we fail
        throw new Exception('Unsupported format');
    }
}


$article = new poly_base_Article('Polymorphism', 'Steve', time(), 0);
 
try {
    $writer = poly_base_Factory::getWriter('json');
}
catch (Exception $e) {
    $writer = new poly_writer_XMLWriter();
}
 
echo $article->write($writer);
