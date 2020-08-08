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
  /* @var $date DateTime */
  $date = DateTime::createFromFormat('Y-m-d H:i:s', $sqlDate);

  return $date->format('d M Y, H:i');
}

function convertSqlDateForNow() {
  return date('Y-m-d H:i:s');
}

/**
 * Converts unsafe text to HTML
 * 
 * @param string $text
 * @return string
 */
function convertNewLinesToParagraphs($text) {
  $escaped = htmlEscape($text);

  return '<p>' . str_replace("\n", "</p><p>", $escaped) . '</p>';
}

function redirectAndExit($script) {
  // Get the domain-relative URL
  $relativeUrl = $_SERVER['PHP_SELF'];
  $urlFolder = substr($relativeUrl, 0, strrpos($relativeUrl, '/') + 1);

  // Redirect to full URL
  $host = $_SERVER['HTTP_HOST'];
  $fullUrl = 'http://' . $host . $urlFolder . $script;
  header('Location: ' . $fullUrl);
  exit();
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