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
    function getNameAt($index) { return $this->names[$index]; }
}
function select($tableName, $fields, $condition = "")
{
    $db = new SQLite3('resources/data.sqlite');
    $q = $db->query("SELECT * FROM $tableName" . (($condition == "") ? "" : (" WHERE " . $condition)));

    $res = array();
    while ($row = $q->fetchArray())
    {
        $r = new DBResult;
        for($i = 0; $i < count($fields); $i++) $r->addField($fields[$i], $row[$fields[$i]]);
        array_push($res, $r);
    }
    return $res;
}
function insert($tableName, $InsertArray)
{
    $db = new SQLite3('resources/data.sqlite');
    $columnsNames = "";
    $values = "";
    for($i = 0; $i < $InsertArray[0]->getCount(); $i++) {
        $columnsNames += $InsertArray[0]->getNameAt($i) + ",";
    }
    for($i = 0; $i < count($InsertArray); $i++)
    {
        $values += "(";
        for($j = 0; $j < $InsertArray[$i]->getCount(); $j++)
            $values += $DBRes[i]->getFieldAt($j) + ",";
        $values = substr($values, 0, -1) + "),";
    }
    $values = substr($values, 0, -1);
    $columnsNames = substr($columnsNames, 0, -1);

    $db->query("INSERT INTO $tableName($columnsNames) VALUES $values");
}
function read($fileDirectory)
{
    $parargraphs = array();
    $fp = fopen($fileDirectory, "r");
    if ($fp) while (!feof($fp)) array_push($parargraphs, fgets($fp, 999));
    fclose($fp);
    return $parargraphs;
}
?>
