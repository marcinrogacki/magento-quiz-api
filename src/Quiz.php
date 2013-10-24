<?php

class Quiz extends SQLite3
{
    private $_projectdir = '';

    private $_dbfile = '';

    private $_tableConfig= 'config'; 

    private $_tableQuestion = 'question'; 

    function __construct()
    {
        $this->_projectdir = __DIR__ . '/..';
        
        $this->_dbfile = $this->_projectdir . '/media/quiz.sqlite';

        @touch($this->_dbfile);

        if (!is_file($this->_dbfile)) {
            throw new Exception(
                "Sqlite database does not exist, is not writable or 'media' dir is not writable"
            );
        }

        $this->open($this->_dbfile);
    }

    public function install()
    {
        $initQueries = $this->_getInitQueries();

        try {
            foreach ($initQueries as $query) {
                $this->exec($query);
            }
        } catch (Exception $e) {
            file_put_contents('logs', $e->getTraceAsString());
            return false; 
        }

        return true; 
    }

    public function isInsalled()
    {
        $query = 'select * from ' . $this->_tableConfig 
               . " where key = 'installed'";
        try {
            $result = $this->query($query)->fetchArray(SQLITE3_ASSOC);
        } catch (Exception $e) {
            return false; 
        }
        
        if (!isset($result['value'])) {
            return false;
        }
        return (bool) $result['value'];
    }


    public function getQuestionRow()
    {
        $query = 'select * from ' . $this->_tableQuestion
               . " LIMIT 1";

        try {
            $result = $this->query($query)->fetchArray(SQLITE3_ASSOC);
        } catch (Exception $e) {
            return false; 
        }
        $result['valid_answer'] = explode(',', $result['valid_answer']);
        return $result;
    }

    private function _getInitQueries()
    {
        $queries = [

            'DROP TABLE IF EXISTS ' . $this->_tableConfig, 
            'DROP TABLE IF EXISTS ' . $this->_tableQuestion, 

            'CREATE TABLE ' . $this->_tableConfig . ' (
                id integer primary key autoincrement,
                key varchar(1024) unique,
                value varchar(1024)
             )',

            "INSERT INTO " . $this->_tableConfig . " VALUES(null, 'installed', '1')",

            'CREATE TABLE ' . $this->_tableQuestion . ' (
                id integer primary key,
                question varchar(1024),
                answer1 varchar(1024),
                answer2 varchar(1024),
                answer3 varchar(1024),
                answer4 varchar(1024),
                valid_answer varchar(255) 
            )',

        ];

        include __DIR__ . '/../questions/basics.php';

        foreach ($__questions__ as $question => $data) {
            $queries[] = sprintf(
                "INSERT INTO %s VALUES(null, '%s', '%s', '%s', '%s', '%s', '%s')",
                $this->_tableQuestion,     
               $this->escapeString($question),
               $this->escapeString($data[0]),
               $this->escapeString($data[1]),
               $this->escapeString($data[2]),
               $this->escapeString($data[3]),
                implode(',', $data[4])
            );
        }
        return $queries;
    }
}
