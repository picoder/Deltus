$('#auth-form').idealforms({

	// For consistency all keys
	// must be in quotes
	inputs : {
		'email' : {
			filters : 'required min max email',
			data : {
				min : 4,
				max : 80
			},

		},
		'password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},
		}
	}
});
