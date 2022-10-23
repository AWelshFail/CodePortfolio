#include <iostream>
#include "bubbleSort.hpp"


using namespace std;

void swap(int array[], int i) {
	int x = array[i];
	array[i] = array[i + 1];
	array[i + 1] = x;
}

void bubbleSort(int array[], size_t arraySize) {
	for (int j = 0; j < arraySize; j++) {
		for (int i = 0; i < arraySize-1; i++) {
			if (array[i + 1] < array[i]) {
				swap(array, i);
			}
		}
	}
	
	for (int i = 0; i < arraySize; i++) {
		cout << array[i] << " ";
	}
}

