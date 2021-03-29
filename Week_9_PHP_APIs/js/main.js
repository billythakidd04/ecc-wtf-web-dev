alert("Welcome to the JS section! Sorry for the mess!");

function isHighest(...values) {
	// create our empty max variable (empty in case of negative numbers)
	var max;
	// loop over values one at a time
	for (var i in values) {
		// set currentVal to values[i]
		var currentVal = values[i];
		// make sure current value is a number or skip
		if (isNaN(currentVal)) {
			console.log("'" + currentVal + '\' is not a number, skipping');
			continue;
		}
		// set max if not already set and if max is less or greater than the current value
		if (max === undefined || max < currentVal) {
			console.log(max + ' is less than ' + currentVal);
			max = currentVal;
		}
	}
	return max;
}

// log out if each value is even or odd
function isEven(...values) {
	// loop over values one at a time
	for (var i in values) {
		// set currentVal to values[i]
		var currentVal = values[i];
		// make sure current value is a number or skip
		if (isNaN(currentVal)) {
			console.log("'" + currentVal + '\' is not a number, skipping');
			continue;
		}
		// make sure we are using the integer value not a string
		currentVal = parseInt(currentVal);
		// if currentVal is even there will be no remainder and the result will be 0 which is false
		if (currentVal % 2) {
			// condition was not 0 therefor there was a remainder 
			console.log(currentVal + ' is odd');
			continue;
		}
		console.log(currentVal + ' is even');
	}
}