<?php

class Db_Object
{
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploated file exceed the upload_max_filesize",
        UPLOAD_ERR_FORM_SIZE => "TThe uploated file exceed the MAX_FILE_SIZE",
        UPLOAD_ERR_PARTIAL => "The uploated file was only partially uploated",
        UPLOAD_ERR_NO_FILE => "No file was uploated",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload"
    );

    public static function find_by_id($id)
    {
        $the_result_array = static::find_query("SELECT * FROM " . static::$db_table . " WHERE id= $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function find_all()
    {
        return static::find_query("SELECT * FROM " . static::$db_table);
    }

    public static function find_query($sql)
    {
        global $database;
        $result = $database->query($sql);
        $array_obj = array();

        while ($row = mysqli_fetch_array($result)) {
            $array_obj[] = static::instantation($row);
        }
        return $array_obj;
    }
    public static function instantation($record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;

        // $the_object->id = $results['id'];
        // $the_object->username = $results['username'];
        // $the_object->first_name = $results['first_name'];

        foreach ($record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        // if atribute exist in array -> return 1 or 0
        return array_key_exists($the_attribute, $object_properties);
    }

    protected function properties()
    {
        $properties = array();
        foreach (static::$db_table_fields as $db_fields) {
            if (property_exists($this, $db_fields)) {
                $properties[$db_fields] = $this->$db_fields;
            }
        }
        return $properties;
    }
    protected function clean_properties()
    {
        global $database;
        $clean_properties = array();
        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public function save()
    {
        // update todo
        return isset($this->id) ? $this->update() : $this->create();
    }

    private function create()
    {
        global $database;
        $properties = $this->clean_properties();
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(", ", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("', '", array_values($properties)) . "')";

        if ($database->query($sql)) {
            $this->id = $database->the_insert_id();
            return true;
        } else return false;
    }
    public function delete()
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " WHERE id= " . $this->id;
        $database->query($sql);
        // if number of deleted rows is 1 -> return true
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }
}
