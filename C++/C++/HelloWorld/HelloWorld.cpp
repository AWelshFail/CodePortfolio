#define _USE_MATH_DEFINES
#include <iostream>
#include <cmath>
#include <iomanip>
#include <string>
#include "utils/greet.hpp"
#include "algorithms/LinearSearch.hpp"
#include "algorithms/bubbleSort.hpp"
#include "multidimentionalArrays/multiArray.hpp"



using namespace std;
using messaging::greet;

void printOddNumbers(int limit) {
	for (int i = 0; i < limit; i++) {
		if (i % 2 != 0) {
			cout << i << endl;
		}
	}
}

void rangeBasedForLoop() {
	int numbers[] = {10, 20};
	for (auto number : numbers)
		cout << number << endl;
}

void indexForLoop() {
	int number[] = { 10, 20 };
	for (auto i = 0; i < size(number); i++)
	{
		cout << number[i] << endl;
	}
}

void copyArray() {
	//c++ does not allow you to initalise one array to another, have to iterate through one array and initalise the results to the second
	int firstA[] = { 1, 2, 3, 4, 5 };
	int secondA[size(firstA)];
	for (int i = 0; i < size(firstA); i++) {
		secondA[i] = firstA[i];
	}
	for (auto index : secondA)
		cout << index << endl;
	
}

void compareArray() {
	int firstA[] = { 1, 2, 3, 4, 5 };
	int secondA[] = {1, 2, 3, 4, 5};
	bool isEqual = true;
	for (auto i = 0; i < size(firstA); i++)
	{
		if (firstA[i] != secondA[i]) {
			isEqual = false;
		}
	}
	cout << boolalpha << isEqual << endl;
}

void printNumbers(int array[], int size) { //passing arrays requires passing the array size as well, this is because when passing an array you are infact passing a pointer to the location of the first index location in memory
	for (int i = 0; i < size; i++)
	{
		cout << array[i] << endl;
	}
}

void unpackArray() {
	int values[3] = { 0, 1, 2 };
	//C++: structured binding only avalible with C++ 17
	//JavaScript: destructuring
	//Python: unpacking
	//auto [x, y, z] = values;
	//cout << x << ", " << y << ", " << z;


}

void pointers() {
	int number = 10;

	int* ptr = &number; //assigns ptr to memory location of number

	*ptr = 20; //Inderection(de-referencing) operator

	cout << number << endl;

	cout << ptr << endl; //prints memory location of what the pointer is pointing to
	cout << &number << endl;

	cout << *ptr << endl;
}

void constantPointers() {
	//const value
	//pointer must match data type of value, const int value must have const int pointer
	const int x = 10;
	const int* ptr = &x;
	//*ptr = 30; this is not accaptable as pointer is constant
	//however pointer can point to different value
	int y = 20;
	ptr = &y;

	//constant pointer
	int c = 10;
	int* const cPtr = &c;
	//cPtr = &x; cannot reassign const pointer to different memory location

	//const value && const pointer
	const int z = 10;
	const int* const ptr2 = &z;
}

void passingPointers(double* price) {
	*price *= 1.2;
}

void passingReference(double& price) {
	price *= 1.2;
}

void swap(int* first, int* second) {
	int x = 0;
	x = *first;
	*first = *second;
	*second = x;
}

void relBetweenPtrArray() {
	int numbers[] = { 10, 20, 30 }; //numbers[] is technicaly a pointer to the address in memory of index 0 in the array, this is why you cant loop through an array without providing the size
	int* ptr = numbers;
	cout << numbers << endl;
	cout << ptr << endl; //both point to the same address in memory
	cout << ptr[1]; //can also be used to access the other elements of the array
}

void ptrMaths() {
	//can only add or subtract pointers, can not multiply or divide
	int numbers[] = { 10, 20, 30 };
	int* ptr = numbers; //pointer is pointing to first element in the array
	ptr++; //incrementing the pointer will increment by the amount of bytes reserved by the data types, in this case the memory address location + 4 bytes
	cout << *ptr; //in other words it will point to the second element of the array
}

void ptrComp() {
	int numbers[] = { 10, 20, 30 };
	int* ptr = &numbers[size(numbers) - 1];
	while (ptr >= numbers) {
		cout << *ptr << endl;
		ptr--;

	}
}

void dynamicMemAllo() {
	//int numbers[100]; this is declared in the stack, variables declared on the stack get auto cleanup (once out of scope, once this method finishes execution, then this memory allocation will be cleared)

	int* numbers = new int[10]; //this is declared in the Heap (free store)
}

int main()
{
	//printNumbers call statment
	//int firstA[] = { 1, 2, 3, 4, 5 };
	//printNumbers(firstA, size(firstA));

	//LinearSearch call statment and setup
	//int intArray[] = { 1, 2, 3, 4, 5 };
	//cout << LinearSearch(intArray, size(intArray), 8);

	//bubbleSort call statment
	//int intArray[] = { 10, 6, 57, 33, 500, 7 };
	//bubbleSort(intArray, size(intArray));

	//passing by pointer || better to pass by reference than pointer
	//double price = 100;
	//passingPointers(&price);
	//passingReference(price);
	//cout << price;
	
	//swap call statment
	//int x = 10;
	//int y = 20;
	//swap(&x, &y);
	//cout << x << ", " << y;

	ptrComp();

	return 0;
	
}

// Run program: Ctrl + F5 or Debug > Start Without Debugging menu
// Debug program: F5 or Debug > Start Debugging menu

// Tips for Getting Started: 
//   1. Use the Solution Explorer window to add/manage files
//   2. Use the Team Explorer window to connect to source control
//   3. Use the Output window to see build output and other messages
//   4. Use the Error List window to view errors
//   5. Go to Project > Add New Item to create new code files, or Project > Add Existing Item to add existing code files to the project
//   6. In the future, to open this project again, go to File > Open > Project and select the .sln file
