<?php
/**
 * CosineSimilarity measures a cosine similarity between two vectors
 *
 */

class CosineSimilarity {
  
  public function similarity(array $vec1, array $vec2) {
    return $this->_dotProduct($vec1, $vec2) / ($this->_absVector($vec1) * $this->_absVector($vec2));
  }
  
  protected function _dotProduct(array $vec1, array $vec2) {
    $result = 0;
    
    foreach ($vec1 as $key1 => $nil1) {
      foreach ($vec2 as $key2 => $nil2) {
	       $result += $vec1[$key1] * $vec2[$key2];
      }
    }
    
    return $result;
  }
  
  protected function _absVector(array $vec) {
    $result = 0;
    
    foreach ($vec as $keke => $value) {
      $result += $value * $value;
    }
    
    return sqrt($result);
  }
}
