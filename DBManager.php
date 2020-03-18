<?php
class DBResult
{
    private $fields, $names;
    function __construct() { $this->fields = array(); $this->names = array(); }
    function addField($name, $value) { array_push($this->names, $name); array_push($this->fields, $value); }
    function writeDebug() { for($i = 0; $i < count($this->fields); $i++) echo $this->fields[$i]; }
    function getCount() { return count($this->fields); }
    function getFieldAt($index) { return $this->fields[$index]; }
    function getFieldByName($name) { return $this->fields[array_search($name, $this->names)]; }
}
function select($tableName, $fields)
{
    $db = new SQLite3('resources/data.sqlite');
    $q = $db->query("SELECT * FROM $tableName");

    $res = array();
    while ($row = $q->fetchArray())
    {
        $r = new DBResult;
        for($i = 0; $i < count($fields); $i++) $r->addField($fields[$i], $row[$fields[$i]]);
        array_push($res, $r);
    }
    return $res;
}
?>
