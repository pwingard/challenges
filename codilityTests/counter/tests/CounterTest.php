<?php

namespace TDD\Test;

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR .'autoload.php';

use PHPUnit\Framework\TestCase;
use TDD\Counter;


class CounterTest extends TestCase {


    /**
     * Sets up test
     * @param $this->Counter->counter_size
     * @param $this->Counter->command_arr_A
     * @method $this->Counter->counter_size, $this->Counter->command_arr_A setUp()
     */
    public function setUp() {
        $this->Counter = new Counter();
        $this->Counter->counter_size=5;
        $this->Counter->command_arr_A = array(0=>1,1=>5,2=>4,3=>6,4=>1,5=>4,6=>4);
    }


    /**
     * Tears down test
     * unsets counter test obj
     * @method tearDown()
     */
    public function tearDown() {
        unset($this->Counter);
    }


    /**
     * Tests DisplayOutput() method
     * @dataProvider provideDisplayOutput
     * @method testDisplayOutput()
     */
    public function testDisplayOutput($error_reason,$ctrArr,$response){
        $this->Counter->error_reason = $error_reason;
        $this->Counter->counter_arr = $ctrArr;

        $this->Counter->DisplayOutput();

        $this->assertEquals(
            $response,
            $this->Counter->output,
            "'$response' expected, but '". $this->Counter->output . "' given."
        );
    }
    /**
     * Test data for method testDisplayOutput()
     * @method array() provideDisplayOutput()
     */
    public function provideDisplayOutput(){
        return [
            'Test displaying correct result'=>[null,array(1=>3, 2=>2, 3=>2, 4=>4, 5=>2),"The resulting counter array [3, 2, 2, 4, 2]"],//no error
            'Test displaying error'=>['There was an error',[],"There was an error"],// error
        ];
    }


    /**
     * Tests CreateCounterArr() method of size N,
     * index starts at 1, all zeroes
     * @method $this->Counter->counter_arr testCreateCounterArr()
     */
    public function testCreateCounterArr() {
        $this->Counter->CreateCounterArr();
        $sizeCreated=count($this->Counter->counter_arr);

        //test size of counter array is correct
        $this->assertEquals(
            $this->Counter->counter_size,
            $sizeCreated,
            "The expected size of the counter array was "
            .$this->Counter->counter_size.", the actual size was $sizeCreated."
        );

        //check if all values in new array are 0
        $this->Counter->allZeros = true;
        foreach($this->Counter->counter_arr as $v) {
            if($v != 0) $this->Counter->allZeros = false;
        }

        //test if all zero
        $this->assertTrue(
            $this->Counter->allZeros,
            "The initialized counter array is not all zeros."
        );

        //test is first index is as required
        $this->assertEquals(
            $this->Counter->index_start,
            key($this->Counter->counter_arr),
            "The counter array index was expected to start at "
            . $this->Counter->index_start.", it started at ".key($this->Counter->counter_arr)." instead."
        );
    }//end testCreateCounterArr


    /**
     * Tests CheckValidCmd() method
     *   $this->selected_counter_cmd
     *   $this->counter_size
     * @dataProvider provideCheckValidCmd
     * @method boolean testCheckValidCmd
     */
    public function testCheckValidCmd($cmd,$ctr_size, $expected){

            $this->Counter->selected_counter_cmd=$cmd;
            $this->Counter->counterSize = $ctr_size;
            $response = $this->Counter->CheckValidCmd();
            $this->assertEquals(
                $expected,
                $response,
                "Expected boolean $expected for command $cmd, but received boolean $response."
            );
    }
    /**
     * Test data for method testCheckValidCmd()
     * provides command, counter size expected response
     * @method array($cmd, $ctr_size, $expected) , testCheckValidCmd()
     *
     */
    public function provideCheckValidCmd(){
        return [
            'data set 1'=>[0, 5, 0],//expected error
            'data set 2'=>[1, 5, true],
            'data set 3'=>[2, 5, true],
            'data set 4'=>[3, 5, true],
            'data set 5'=>[4, 5, true],
            'data set 5'=>[5, 5, true],
            'data set 5'=>[6, 5, true],
            'data set 5'=>[7, 5, 0],//expected error
        ];
    }


    /**
     *  Tests IncrCounter() method
     * @dataProvider provideIncrCounter
     * @param $ctr_arr
     * @param $sel_ctr
     * @return $expected_arr_incr
     * @method array($ctr_arr, $sel_ctr, $expected_arr_incr) , testIncrCounter()
     */
    public function testIncrCounter($ctr_arr,$sel_ctr, $expected_arr_incr) {
        $this->Counter->counter_arr = $ctr_arr;
        $this->Counter->selected_counter = $sel_ctr;
        $this->Counter->IncrCounter();
        $resp_arr=$this->Counter->counter_arr;

        $this->assertEquals(
            $expected_arr_incr,
            $resp_arr,
            "Incrementing counter failed."
            );
    }
    /**
     * Test data for method testIncrCounter()
     * @return $ctr_arr counter array to be incremented
     * @return $sel_ctr the selected element or counter to increment
     * @return $expected_arr_incr the expected result array after incremneting
     * @method array($ctr_arr, $sel_ctr, $expected_arr_incr) , testCheckValidCmd()
     */
    public function provideIncrCounter(){
        return [
            'data set 2'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 1, [1 => 2, 2 => 2, 3 => 5, 4 => 4, 5 => 1]],
            'data set 3'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 2, [1 => 1, 2 => 3, 3 => 5, 4 => 4, 5 => 1]],
            'data set 4'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 3, [1 => 1, 2 => 2, 3 => 6, 4 => 4, 5 => 1]],
            'data set 5'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 4, [1 => 1, 2 => 2, 3 => 5, 4 => 5, 5 => 1]],
            'data set 6'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 5, [1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 2]],
        ];
    }


    /**
     *  Tests MaxCtrArr() method replaces all counter elements with selected value
     * @dataProvider provideMaxCtrArr
     * @param $ctr_arr
     * @param $sel_ctr
     * @return $expected_max_arr
     * @method array($ctr_arr, $sel_ctr, $expected_max_arr) , testMaxCtrArr()
     */
    public function testMaxCtrArr($ctr_arr,$sel_ctr, $expected_max_arr) {
        $this->Counter->counter_arr = $ctr_arr;
        $this->Counter->largest_counter_val = $sel_ctr;//whether largest or not, sets all arr val to this
        $this->Counter->MaxCtrArr();
        $resp_arr=$this->Counter->counter_arr;

        $this->assertEquals(
            $expected_max_arr,
            $resp_arr,
            "Maxing out counter failed."
        );
    }
    /**
     * Test data for method testMaxCtrArr()
     * @return $ctr_arr counter array to be maxed out
     * @return $sel_ctr the selected element or counter to use to replace all values
     * @return $expected_max_arr the expected result array after maxing out
     * @method array($ctr_arr, $sel_ctr, $expected_max_arr) , testMaxCtrArr()
     */
    public function provideMaxCtrArr(){
        return [
            'data set 1'=>[[1 => 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 5, [1 => 5, 2 => 5, 3 => 5, 4 => 5, 5 => 5]],
            'data set 2'=>[[1 => 1, 2 => 2, 3 => 2, 4 => 4, 5 => 1], 4, [1 => 4, 2 => 4, 3 => 4, 4 => 4, 5 => 4]],
        ];
    }


    /**
     *  Tests CheckIntInput() tests method that checks that user input is integer
     * @dataProvider provideCheckIntInput
     * @param $command_arr_A
     * @param $counter_size
     * @return bolean
     * @method array($command_arr_A, $counter_size, $expected_resp) , testCheckIntInput()
     */
    public function testCheckIntInput($command_arr_A,$counter_size, $expected_resp) {
        $this->Counter->command_arr_A = $command_arr_A;
        $this->Counter->counter_size = $counter_size;
        $resp = $this->Counter->CheckIntInput();

        $this->assertEquals(
            $expected_resp,
            $resp,
            "TestCheckIntInput failed to return expected response."
        );
    }
    /**
     * Test data for method testCheckIntInput()
     * @return bolean returns true if integer
     * @method array($command_arr_A, $counter_size, $expected_resp) , testCheckIntInput()
     */
    public function provideCheckIntInput(){
        return [
            'data set 1'=>[[1=> 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 5, true],//good data
            'data set 2'=>[[0=>11.5, 1 => 1, 2 => 2, 3 => 2, 4 => 4, 5 => 1], 5, false],//bad data
            'data set 3'=>[[0=>11, 1 => 1, 2 => 2, 3 => 2, 4 => 4, 5 => 1], 0.7, false],//bad data
            'data set 3'=>[[0=>0, 1 => 1, 2 => 2, 3 => 2, 4 => 4, 5 => 1], 0.7, false],//bad data
        ];
    }


    /**
     * Tests FindLargestValInArray() tests if method selects largest value in passed array
     * @dataProvider provideFindLargestValInArray
     * @param $this->counter_arr
     * @return $this->largest_counter_val
     * @method array($counter_arr, $expected_resp) , testFindLargestValInArray()
     */
    public function testFindLargestValInArray($counter_arr, $expected_resp) {
        $this->Counter->counter_arr = $counter_arr;
        $this->Counter->FindLargestValInArray();
        $resp = $this->Counter->largest_counter_val;

        $this->assertEquals(
            $expected_resp,
            $resp,
            "testFindLargestValInArray failed to return expected response."
        );
    }
    /**
     * Test data for method testFindLargestValInArray()
     * @return $this->largest_counter_val integer
     * @method array($counter_arr, $expected_resp) , testFindLargestValInArray()
     */
    public function provideFindLargestValInArray(){
        return [
            'data set 1'=>[[1=> 1, 2 => 2, 3 => 5, 4 => 4, 5 => 1], 5],//good data
            'data set 2'=>[[0=>2, 1 => 2, 2 => 2, 3 => 2, 4 => 2, 5 => 2], 2]
        ];
    }


    /**
     * Tests CycleCounterInputs() executes array A on N counters
     * @dataProvider provideFindLargestValInArray
     * @param $this->command_arr_A array() (set up)
     * @param $this->$this->counter_arr array() (mock)
     * @return $this->counter_arr array() (updated)
     * @method testCycleCounterInputs()
     */
    public function testCycleCounterInputs(){

        //$this->Counter->command_arr_A = array(0=>1,1=>5,2=>4,3=>6,4=>1,5=>4,6=>4);

        $Counter = $this->getMockBuilder('TDD\Counter')
        ->setMethods(['CreateCounterArr'])
        ->getMock();

        $Counter->method('CreateCounterArr')
        ->will($this->returnValue(array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0)));
        $this->Counter->CreateCounterArr();

        $this->Counter->CycleCounterInputs();

        $expected_resp = [1=>2, 2=>1, 3=>1, 4=>3, 5=>1];
        $resp = $this->Counter->counter_arr;

        $this->assertEquals(
            $expected_resp,
            $resp,
            "testCycleCounterInputs failed to return expected response."
        );

    }






    //testCycleCounterInputs mock should not use display output



//
//$test_counter_arr = $Counter->CreateCounterArr();


//            $Counter = $this->getMockBuilder('TDD\Counter')
//            ->setMethods(['CreateCounterArr'])
//            ->getMock();
//            $Counter->method('CreateCounterArr')
//            ->will($this->returnValue(array( 1=>0, 2=>0, 3=>0, 4=>0, 5=>0)));

//            $test_counter_arr = $Counter->CreateCounterArr();


//$Counter = $this->getMockBuilder('TDD\Counter')
//->setMethods(['CreateCounterArr'])
//->getMock();
//$Counter->method('CreateCounterArr')
//->will($this->returnValue(array( 1=>0, 2=>0, 3=>0, 4=>0, 5=>0)));
//$test_counter_arr = $Counter->CreateCounterArr();
//
//$valid=true;
//$max_cmd=count($test_counter_arr) + 1;
//foreach ($this->Counter->command_arr_A as $cmd) {
//if($cmd < 1 || $cmd >$max_cmd){
//$valid = false;
//break;
//}
//}
//$this->assertTrue(
//    $valid,
//    "The command data array A has invalid command $cmd."
//);

//        $Receipt = $this->getMockBuilder('TDD\Receipt')
//            ->setMethods(['tax', 'total'])
//            ->getMock();
//        $Receipt->method('total')
//            ->will($this->returnValue(10.00));
//        $Receipt->method('tax')
//            ->will($this->returnValue(1.00));
//        $result = $Receipt->postTaxTotal([1,2,5,8], 0.20, null);
//        $this->assertEquals(11.00, $result);








//        $Counter = $this->getMockBuilder('TDD\Counter')
//            ->setMethods(['CreateCounterArr'])
//            ->getMock();
//        $Counter->method('CreateCounterArr')
//            ->will($this->returnValue(array(1=>2,2=>4,3=>7)));
//
//            ->will($Counter->selected_counter->key($this->returnValue(array(1=>2,2=>4,3=>7))));
//




        //test IncrCounter
//        $pre_incr = $this->Counter->selected_counter + 1;
//        $this->Counter->IncrCounter();
//
//        $this->assertEquals(
//                $pre_incr,
//                $this->Counter->selected_counter,
//                "The increased counter count was ". $this->Counter->selected_counter
//                . ", the expected size was ". $pre_incr
//        );


}