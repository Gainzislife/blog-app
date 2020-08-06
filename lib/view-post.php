<?php

/**
 * Retrieves a post
 * 
 * @param PDO $pdo
 * @param integer $postId
 * @throws Exception
 */
function getPostRow(PDO $pdo, $postId) {
  $query = 'SELECT title, created_at, body
          FROM post
          WHERE id = :id';
  $stmt = $pdo->prepare($query);

  if ($stmt === false) {
    throw new Exception('There was a problem preparing this query');
  }

  $result = $stmt->execute(array('id' => $postId,));

  if ($result === false) {
    throw new Exception('There was a problem running this query');
  }

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row;
}
