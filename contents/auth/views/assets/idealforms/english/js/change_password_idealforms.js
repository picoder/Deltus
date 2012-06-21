$('#auth-form').idealforms({

	// For consistency all keys
	// must be in quotes
	inputs : {
		
		'old_password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},

		},
		
		'new_password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},

		},
		
		'confirm_new_password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},

		}
	}
});
