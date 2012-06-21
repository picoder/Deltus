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
			errors: {
		    required: 'Pole należy uzupełnić',
		    min: 'Minimalna liczba znaków to 4',
		    max: 'Maksymalna liczba znaków to 32',
		    },

		},
		'email' : {
			filters : 'required min max email',
			data : {
				min : 4,
				max : 80
			},
			errors: {
		    required: 'Pole należy uzupełnić',
		    min: 'Minimalna liczba znaków to 4',
		    max: 'Maksymalna liczba znaków to 80',
		    email: 'Pole należy uzupełnić adresem e-mail (np. user@wp.pl)',
		    },

		},
		'password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},
			errors: {
		    required: 'Pole należy uzupełnić',
		    min: 'Minimalna liczba znaków to 4',
		    max: 'Maksymalna liczba znaków to 32',
		    },
		},
		'confirm_password' : {
			filters : 'required min max',
			data : {
				min : 4,
				max : 32
			},
			errors: {
		    required: 'Pole należy uzupełnić',
		    min: 'Minimalna liczba znaków to 4',
		    max: 'Maksymalna liczba znaków to 32',
		    },

		},
		'captcha' : {
			filters : 'required',
			errors: {
		    required: 'Pole należy uzupełnić',
		    },
		}
	},
	onFail: function () {
      alert('Błędnie wypełniono pola formularza!')
    },
});
