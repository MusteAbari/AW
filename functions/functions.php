<?php
$server = '127.0.0.1';
$username = 'root';
$password = '';

$schema = 'aw';
$port = 3306;

 $pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Is given two arguments, the first being the filename second templateVars
function loadTemplate($filename, $templateVars) {
  extract($templateVars);
  ob_start();
  require $filename;
  $contents = ob_get_clean();
  return $contents;
}

//Find particular field
function find($pdo, $table, $field, $value, $order=false) {
        if ($order!= false ) {
          $order = " order by " . $order;
        }
        $stmt = $pdo->prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value ' . $order);
        $criteria = [
                'value' => $value
        ];
        $stmt->execute($criteria);
        return $stmt;
}

//Finds all from any table
function findAll($pdo, $table, $order=false) {
  if ($order!= false ) {
    $order = " order by " . $order;
  }
        $stmt = $pdo->prepare('SELECT * FROM ' . $table . $order );

        $stmt->execute();

        return $stmt;
}

//Finds a user by ID
function findAdminById($pdo, $id) {
        $stmt = $pdo->prepare('SELECT * FROM admin WHERE id = :id');
        $criteria = [
        'id' => $id
        ];
        $stmt->execute($criteria);
        return $stmt->fetch();
}
/* How you'd use it
$person = findPersonById($pdo, 123);
echo $person['firstname'];
echo $person['surname'];
*/

//Finds a user by username
function findDJByusername($pdo, $username) {
        $stmt = $pdo->prepare('SELECT * FROM dj WHERE username = :username');
        $criteria = [
        'username' => $username
        ];
        $stmt->execute($criteria);

        return $stmt->fetch();
}



//Admin Login
function adminlogin($pdo, $username, $password) {
        $stmt = $pdo->prepare('SELECT * FROM admin WHERE username = :username AND password = :password');

        $criteria = [
              'username' => $_POST['username'],
              'password' => sha1($_POST['password'])
            ];
        $stmt->execute($criteria);

        return $stmt;
}

//Insert a record
function insert($pdo, $table, $record) {
    $keys = array_keys($record);

    $values = implode(', ', $keys);
    $valuesWithColon = implode(', :', $keys);

    $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

    $stmt = $pdo->prepare($query);

    $stmt->execute($record);
}
// How it would be used -  $stmt = insert($pdo, 'dj', $criteria);

//Update a record
function update($pdo, $table, $record, $primaryKey) {
         $query = 'UPDATE ' . $table . ' SET ';

          $parameters = [];
         foreach ($record as $key => $value) {
                $parameters[] = $key . ' = :' .$key;
              }

          $query .= implode(', ', $parameters);
         $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';

         $record['primaryKey'] = $record[$primaryKey];

         $stmt = $pdo->prepare($query);

         $stmt->execute($record);
}

//Delete a record
function delete($pdo, $table, $field, $value) {
        $stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE ' . $field . ' = :value');
        $criteria = [
        'value' => $value
      ];
      $stmt->execute($criteria);

      return $stmt;
}

//Save a record, If insert doesnt work, this function will perform an update query
function save($pdo, $table, $record, $primaryKey) {
     try {
           insert($pdo, $table, $record);
     }
     catch (Exception $e) {
           update($pdo, $table, $record, $primaryKey);
    }
}
