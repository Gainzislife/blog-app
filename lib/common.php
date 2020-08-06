<?php
require_once('database.php');
/**
 * Escapes HTML for safe output
 * 
 * @param string $html
 * @return string
 */
function htmlEscape($html) {
  return htmlspecialchars($html, ENT_HTML5, 'UTF-8');
}

function convertSqlDate($sqlDate) {
  $date = DateTime::createFromFormat('Y-m-d', $sqlDate);

  return $date->format('d M Y');
}

/**
 * Returns the number of comments for a post
 * 
 * @param integer $postId
 * @return integer
 */
function countCommentsForPost($postId) {
  global $db;
  $query = "SELECT COUNT(*)
            FROM comment
            WHERE post_id = :post_id";
  $stmt = $db->prepare($query);
  $stmt->execute(array('post_id' => $postId, ));

  return (int) $stmt->fetchColumn();
}

/**
 * Returns the comments for a post
 * 
 * @param integer $postId
 */
function getCommentsForPost($postId) {
  global $db;

  $query = "SELECT id, name, text, created_at, website
            FROM comment
            WHERE post_id = :post_id";
  $stmt = $db->prepare($query);
  $stmt->execute(array('post_id' => $postId, ));

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}