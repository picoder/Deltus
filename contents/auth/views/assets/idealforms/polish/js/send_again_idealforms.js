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
			errors: {
		    required: 'Pole należy uzupełnić',
		    min: 'Minimalna liczba znaków to 4',
		    max: 'Maksymalna liczba znaków to 32',
		    email: 'Pole należy uzupełnić adresem e-mail (np. user@wp.pl)',
		    },

		}
	},
	onFail: function () {
      alert('Błędnie wypełniono pola formularza!')
    },
});
