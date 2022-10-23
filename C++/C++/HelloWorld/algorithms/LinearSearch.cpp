#include <iostream>
#include "LinearSearch.hpp"


using namespace std;

int LinearSearch(int searchArray[], size_t size, int searchInt)
{
	for (int i = 0; i < size; i++) {
		if (searchArray[i] == searchInt) {
			return i;
		}
	}
	return -1;
}
