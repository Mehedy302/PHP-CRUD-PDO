<?php
/**
 * User: TheCodeholic
 * Date: 3/19/2019
 * Time: 9:27 AM
 */
 
function getUsers()
{
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}

function getUserById($id)
{
   $conn = getConn();

    $query = $conn->prepare("SELECT * FROM crud_application WHERE isbn = ?");
    $query->execute(($id));
    return $query->fetchColumn();
}

function createUser($data)
{
    $users = getUsers();

     
    $users[] = $data;

    putJson($users);

    return $data;
}

function updateUser($data, $id)
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser = array_merge($user, $data);
        }
    }

    putJson($users);

    return $updateUser;
}

function deleteUser($id)
{
    $users = getUsers();

    foreach ($users as $i => $user) {
        if ($user['isbn'] == $id) {
            array_splice($users, $i, 1);
        }
    }

    putJson($users);
}

 
function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function validateUser($user, &$errors)
{
    $isValid = true;
    // Start of validation
    if (!$user['title']) {
        $isValid = false;
        $errors['title'] = 'Book Title Is Mandatory';
    }
    if (!$user['author']  ) {
        $isValid = false;
        $errors['author'] = 'Author Name Is Mandatory';
    }
    if (!$user['isbn'] ) {
        $isValid = false;
        $errors['isbn'] = 'ISBN Number Must Be Included';
    }

    if (!filter_var($user['pages'], FILTER_VALIDATE_INT)) {
        $isValid = false;
        $errors['pages'] = 'Page Number Must Be Integer';
    }
    // End Of validation

    return $isValid;
}
