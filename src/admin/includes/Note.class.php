<?php
class Note extends Db_Object {
    protected static $db_table = "notes";
    protected static $db_table_fields = array('title', 'body', 'category', 'author');
    public $id;
    public $title;
    public $body;
    public $category;
    public $author;

    public static function find_notes_by_author($id)
    {
        return static::find_query("SELECT * FROM " . self::$db_table . " WHERE author = " . $id);
    }
}