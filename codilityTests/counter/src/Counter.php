<?php

namespace TDD;

class Counter {

    public $index_start = 1;
    public $fill_val = 0;
    public $counter_size;//N
    public $command_arr_A = array();//A


    /**
     * Creates array of N counters
     * @method (creates) $this->Counter->counter_arr, array(int), CreateCounterArr()
     */
    public function CreateCounterArr() {
        $this->CheckIntInput();
        $this->counter_arr = array_fill($this->index_start, $this->counter_size, $this->fill_val);
    }


    /**
     * Cycles thru $this->Counter->command_arr_A
     * and executes commands on $this->Counter->counter_arr
     * @method (updates) $this->Counter->counter_arr, CycleCounterInputs()
     */
    public function CycleCounterInputs() {
        foreach ($this->command_arr_A as $counter_cmd) {

            $this->selected_counter_cmd = $counter_cmd;
            $this->selected_counter = $counter_cmd;

            if ($this->CheckValidCmd()) {
                if ($this->selected_counter_cmd <= $this->counter_size) {
                    //increment counter cmd
                    $this->IncrCounter();
                }
                elseif ($this->selected_counter_cmd == ($this->counter_size + 1)) {
                    //get largest value
                    $this->FindLargestValInArray();
                    //update all registers to max value
                    $this->MaxCtrArr();
                }
            }
            else {
                $this->error_reason = "Bad Command " . $this->selected_counter_cmd . PHP_EOL;
                $this->DisplayOutput();
                die();
            }
        }
    }


    /**
     * Checks if $this->selected_counter_cmd is valid
     * @method boolean CheckValidCmd()
     */
    public function CheckValidCmd() {
        //can't be less than one or greater than $counterSize
        if ($this->selected_counter_cmd < 1 || $this->selected_counter_cmd > $this->counter_size + 1) {
            return false;
        }
        return true;
    }


    /**
     * Increments current counter element
     * @method void, acts on $this->selected_counter, IncrCounter()
     */
    public function IncrCounter() {
        //increase(X) − counter X is increased by 1,
        $this->counter_arr[$this->selected_counter]++;
    }


    /**
     * Finds the largest value in $this->counter_arr
     * @method $this->largest_counter_val, integer, FindLargestValInArray()
     */
    public function FindLargestValInArray() {
        //Find Largest Value In Array
        $this->largest_counter_val = max($this->counter_arr);
    }


    /**
     * Resets every element in $this->counter_arr to max value $this->largest_counter_val
     * @method $this->counter_arr, MaxCtrArr()
     */
    public function MaxCtrArr() {
        //Find Largest Value In Array
        foreach ($this->counter_arr as $key => $ctr) {
            $this->counter_arr[$key] = $this->largest_counter_val;
        }
    }


    /**
     * Outputs either $this->error_reason or formats resulting $this->counter_arr
     * for output
     * @method string $this->output DisplayOutput()
     */
    public function DisplayOutput() {
        if (isset($this->error_reason)) {
            $this->output = $this->error_reason;
        }
        else {
            $this->output = "The resulting counter array [";
            foreach ($this->counter_arr as $ctr => $val) {
                $this->output .= "$val, ";
            }
            $this->output = rtrim($this->output, ", ");
            $this->output .= "]";
        }
    }


    /**
     * Includes lines for turning on error reporting
     * @method void sets error_reporting TurnOnErrorReporting(
     */
    public function TurnOnErrorReporting() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    }


    /**
     * Checks for integers in user inputs A & N
     * @method string $this->output CheckIntInput()
     */
    public function CheckIntInput() {

        $is_integer = is_int($this->counter_size);
        foreach ($this->command_arr_A as $cmd) {
            if (!$is_integer) {
                $this->error_reason = "Input is not integer.";
                $this->DisplayOutput();
                return false;
            }
            $is_integer = is_int($cmd);
        }//end foreach
        return true;
    }//end checkinput

}//end class
