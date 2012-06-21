$('#auth-form').idealforms({

	// For consistency all keys
	// must be in quotes
	inputs : {
		'login' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},

		},
		'password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},

		},
		'captcha' : {
			filters : 'required'
		}
	}
});
