ProtView.Structure.View.ProteinView = Backbone.View.extend({
	el : '#protein-form',
	initialize : function(args) {
		this.modelBinder = new Backbone.ModelBinder();
		this.template = _.template($('#protein-form-template').html());
		this.bindings = {
				name: '#protein-name',
				species: '#protein-species',
				note: '#protein-note'
			};
	},
	events: { 
		'click #protein-form-submit' : 'submitForm'
	},
	unload : function() {
		this.modelBinder.unbind();
	},
	setController : function(controller) {
		this.controller = controller;
	},
	setModel : function(model) {
		model.on('change', this.render, this);	
		model.on('reset', this.render, this);
		model.on('validated:valid', this.valid, this);
		model.on('validated:invalid', this.invalid, this); 
		this.model = model;
	},
	valid : function() {
		console.log('valid');
	},
	invalid : function() {
		console.log('invalid');
	},
	submitForm : function(e) {
        e.preventDefault();
        console.log('model: ' + this.model.isValid());

        this.controller.save();
    },
	render : function() {
		var modelBinder = this.modelBinder,
		model = this.model,
		el = this.el,
		bindings = this.bindings,
		template = this.template;
		console.log('model');
		console.log(model);
		var renderedContent = template(model.toJSON());
		//var theme = 'summer';
        $(el).html(renderedContent);

        /*$(el).jqxValidator({
            rules: [
                   { input: '#protein-name', message: 'Name required!', action: 'keyup, blur', rule: 'required' }], theme: theme
           });
        $(el).bind('validationSuccess', function (event) { 
        	console.log('success');
        }); */
        Backbone.Validation.bind(this);
        modelBinder.bind(model, el, bindings);

		return this;
	},
});