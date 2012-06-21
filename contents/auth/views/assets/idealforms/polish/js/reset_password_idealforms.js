$('#auth-form').idealforms({

	// For consistency all keys
	// must be in quotes
	inputs : {
		
		'new_password' : {
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
		
		'confirm_new_password' : {
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

		}
	},
	onFail: function () {
      alert('Błędnie wypełniono pola formularza!')
    },
});
