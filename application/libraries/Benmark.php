<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * step
 * 
 *  include( 'benmark.php' );
 *  $bm = new Timer; /// call class
 *	$bm->start(); /// start
 * 
 * 	Coding....
 * 
 * 	$bm_end = $bm->stop();
 */
class Benmark
{
	private $elapsedTime;
    // start timer
    public function start()
    {
        if( !$this->elapsedTime = $this->getMicrotime() )
        {
            throw new Exception( 'Error obtaining start time!' );
        };
    }

    // stop timer
    public function stop()
    {
		$result = 0;

        if( !$result = round( $this->getMicrotime() - $this->elapsedTime , 10 ) )
        {
            throw new Exception( 'Error obtaining stop time!' );
        };
        return $result;
    }

    // define private 'getMicrotime()' method
    private function getMicrotime()
    {
        list( $useg , $seg ) = explode( ' ' , microtime() );
        return ( (float)$useg + (float)$seg );
    }
}
