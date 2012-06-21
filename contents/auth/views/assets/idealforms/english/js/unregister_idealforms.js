$('#auth-form').idealforms({

	// For consistency all keys
	// must be in quotes
	inputs : {
		'password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},
		}
	}
});
