<?php

abstract class core_model_db extends core_model_abstract
{
    /**
     * Gets table name.
     */
    abstract public function table();

    /**
     * Gets id column name.
     */
    abstract public function primary();

    /**
     * Gets db adapter
     */
    public function adapter()
    {
        return factories::get()->obj('core_model_mysql')->adapter(); 
    }
  
    public function exists($id = null)
    {
        $id = is_null($id) ? $this->get($this->primary()) : $id;

        if (is_null($id)) {
            return false;
        }

        $id = (int) $id;

        $adapter = $this->adapter();
        $where = sprintf('%s = ?', $this->primary());
        
        $query = $adapter->select()
            ->from($this->table())
            ->columns($this->primary())
            ->where($where, $id, 'INTEGER')
            ->query();

        return (bool) $query->fetch();
    }

    public function load($value, $column = null)
    {
        $column = is_null($column) ? $this->primary() : $column;

        $adapter = $this->adapter();

        $where = sprintf('%s = ?', $column);
        $query = $adapter->select()
            ->from($this->table())
            ->where($where, $value)
            ->query();

        $this->set($query->fetch());
        return $this->is();
    }

    public function collection($columns = '*', $whereVal = null, $whereColumn = null)
    {
        $adapter = $this->adapter();
       
        $select = $adapter->select()
            ->from($this->table(), $columns);
 
        if ($whereVal) {
            if (is_null($whereColumn)) {
                $whereColumn = $this->primary();
            }
            $where = sprintf('%s = ?', $whereColumn);
            $select->where($where, $whereVal);
        }

        $rows = $select->query()->fetchAll(); 
        return $rows;
    }

    public function save()
    {
        $adapter = $this->adapter();

        if (!$this->exists()) {
            $adapter->insert($this->table(), $this->get()); 
            $id = $adapter->lastInsertId();
            $this->set($id, $this->primary());
        } else {
            $where[$this->primary() . ' = ?'] = $this->get($this->primary());
            $adapter->update($this->table(), $this->get(), $where); 
        }
    } 

    public function delete()
    {
        if ($this->exists()) {
            $adapter = $this->adapter();
            $id = $this->primary();
            $value = $this->get($this->primary());
            $where = $adapter->quoteInto("$id = ?", $value);
            $adapter->delete($this->table(), $where); 
            return true;
        }
        return false;
    }

    /**
     * Defines validation for properties
     * @return array
     */
    public function validator($key, validator_abstractModel $validator)
    {
        $this->_validators[$key] = $validator;
    }
}
