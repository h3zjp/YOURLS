<?php
/** 
 * 何となーく発音できるランダム文字列ジェネレータクラス ZumomoPassword
 *
 * 使い方： 
 * <pre>
 *  require_once ('url.php)';
 *  
 *  $zumomo = new ZumomoPassword(8);  // サイズ＝8バイトで。
 *  $pass = $zumomo->generate();      // 8バイトぐらいのランダム文字列
 *  $pass = $zumomo->generate(true);  // ちょうど8バイトのランダム文字列
 * </pre>
 *
 * Copyright(c) 2004 zumomo.org 
 * 
 * @author Katamari 
 * @access public
 * @version 0.04
 * @create 2004/01/29
 * @see http://www.hotwired.co.jp/webmonkey/2001/42/index3a_page2.html
 */
//
//   0.04 2004/01/29 'v'追加
//   0.03 2004/01/29 rand->mt_randに変更
//   0.02 2004/01/29 初期化時のseedをちょっと変えた
//   0.01 2004/01/28 新規作成
//
class ZumomoPassword {
 
	var $_tokens;
	var $_token_max;
	var $_size;
 
	/**
	 * コンストラクタ。
	 *
	 * @param int $size 生成するパスワード文字列長
	 */
	function ZumomoPassword($size = 8) {
		
		// サイズ
		$this->_size = $size;
		
		// 定型処理
		// define tokens
		$this->_tokens = array (
		  // vowels
		  array(
		  'a', 'i', 'u', 'e', 'o', 
		  'ai', 'au', 'ao', 'an', 
		  'ia', 'iu', 'io', 'in',
		  'ua', 'ui', 'uo', 'un', 
		  'eo', 'en',
		  'oi', 'ou', 'on'
		  ),
		 // consonants
		 array(
		 'k','s','t','m','r','g','z','d','b','p','f',
		 'k','s','t','m','r','g','z','d','b','p',
		 'sh', 'th', 'v'
		  )
		);
		 
		// token size
		$this->_token_max = array(
			sizeof($this->_tokens[0]) - 1, sizeof($this->_tokens[1]) - 1);
		 
		// randomize
		mt_srand((double) microtime() * 1000000 );
	 
	}
	 
	/**
	 * 文字列を生成して返します。
	 * 
	 * @access public
	 * @param boolean $strict  trueの場合、ちょうど文字列長＝sizeの文字列を返します。
	 *                         falseの場合、文字列長={size ～ (size+2)} ぐらい。
	 * @return String ランダムに生成された文字列
	 */
	function generate($strict = false) {
	 
		$pass = '';
		 
		// start from vowel(10%) : consonant(90%)
		$i = (mt_rand(0,9) == 0) ? 0 : 1;
		 
		// add until passwordsize
		while(strlen($pass) < $this->_size) {
		 
			// add .(dot) (4%)
			$pass .= ($pass != '' and $i == 1 and rand(0, 25) == 0) ?
				 '.' : '';
			 
			// add token
			$pass .= $this->_tokens[$i][rand(0, $this->_token_max[$i])];
			 
			// next
			$i = ($i == 0) ? 1 : 0;
		}
		 
		// capitalize(20%)
		$pass = (rand(0, 4) == 0) ? ucfirst($pass) : $pass;
		 
		// return
		return $strict ? substr($pass, 0, $this->_size) : $pass;
	}
 
}
?>
