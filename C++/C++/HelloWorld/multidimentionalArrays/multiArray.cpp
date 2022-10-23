#include <iostream>
#include "multiArray.hpp"

const int rows = 2;
const int columns = 3;

void printMatrix(int matrix[rows][columns]) {
	for (int row = 0; row < rows; row++) {
		for (int col = 0; col < columns; col++) {
			std::cout << matrix[row][col] << ", ";
		}
	}
}

void multiArray() {
	

	int matrix[rows][columns] = {
		{11, 12, 13},
		{21, 24, 54}
	};
	
	printMatrix(matrix);
	
}
