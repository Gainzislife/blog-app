<?php
/**
 * Escapes HTML for safe output
 * 
 * @param string $html
 * @return string
 */
function htmlEscape($html) {
  return htmlspecialchars($html, ENT_HTML5, 'UTF-8');
}