<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SortController extends Controller
{
    // Sort Display
    public function sort()
    {
    	$params = [];

    	for ($i = 0; $i < 5; $i++) {
    		$params[] = rand(0, 100);
    	}

    	return response()->json([
    		'before_data' => $params,
    		'bubble_sort' => $this->bubbleSort($params),
    		'selection_sort' => $this->selectionSort($params),
    		'insertion_sort' => $this->insertionSort($params),
    		'quick_sort' => $this->quickSort($params)
    	]);
    }

    /**
     * Bubble Sort 比較相鄰的元素。如果第一個比第二個大，就交換
     * 平均 O(n^2)
     * 最佳 O(n)
     * 最差 O(n^2)
     */
    private function bubbleSort($params)
    {
    	$num = count($params);

    	for ($i = 0; $i < $num; $i++) {
    		for ($j = 0; $j < $num - 1; $j++) {
    			if ($params[$j] > $params[$j + 1]) {
    				$tmp = $params[$j + 1];
    				$params[$j + 1] = $params[$j];
    				$params[$j] = $tmp;
    			}
    		}
    	}

    	return $params;
    }

    /**
     * Selection sort 首先在序列中找到最小 (大)元素，存放到排序序列的起始位置，然後，再從剩餘未排序元素中繼續尋找最小 (大)元素，以此類推，直到所有元素均排序完畢
     * 平均 O(n^2)
     * 最佳 O(n^2)
     * 最差 O(n^2)
     */
    private function selectionSort($params)
    {
    	$num = count($params);

    	for ($i = 0; $i < $num - 1; $i++) {
    		$minPosition = $i;
    		for ($j = $i + 1; $j < $num; $j++) {
    			if ($params[$j] < $params[$minPosition]) {
    				$minPosition = $j;
    			}
    		}

    		$tmp = $params[$i];
	    	$params[$i] = $params[$minPosition];
	    	$params[$minPosition] = $tmp;
    	}

    	return $params;
    }

    /**
     * Insertion Sort 從第一個元素開始，取出下一個元素，往前比對若值大於比對則停止然後移至該位置
     * 平均 O(n^2)
     * 最佳 O(n)
     * 最差 O(n^2)
     */
    private function insertionSort($params)
    {
    	$num = count($params);

    	for ($i = 1; $i < $num; $i++) {
    		$prePosition = $i - 1;
    		$current = $params[$i];

    		while ($prePosition >= 0 && $params[$prePosition] > $current) {
    			$params[$prePosition + 1] = $params[$prePosition];
    			$prePosition--;
    		}

    		$params[$prePosition + 1] = $current;
    	}

    	return $params;
    }

    /**
     * Quick Sort 從數列中挑出一個元素當基準，所有元素比基準值小的擺放在基準前面，所有元素比基準值大的擺在基準的後面，遞迴排序
     * 平均 O(nlog2n)
     * 最佳 O(nlog2n)
     * 最差 O(n^2)
     */
    private function quickSort($params)
    {
    	$num = count($params);

    	if ($num <= 1) {
    		return $params;
    	}

		$large = [];
		$small = [];
		$flag = $params[0];

		for ($i = 1; $i < $num; $i++) {
			if ($params[$i] > $flag) {
				$large[] = $params[$i];
			} else {
				$small[] = $params[$i];
			}
		}

		$large = $this->quickSort($large);
		$small = $this->quickSort($small);

		return array_merge($small, [$flag], $large);
    }
}
