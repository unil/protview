ProtView.Core.View = Backbone.View.extend({
	initialize : function(args) {		
		if (args.el == null)
			console.log('ProtView.Core.View: define el');
		if (args.templateEl == null)
			console.log('ProtView.Core.View: define templateEL');
		
		this.modelBinder = new Backbone.ModelBinder();
		this.template = _.template($(args.templateEl).html());
		this.bindings = args.bindings;
		this.el = args.el;
	},
	unload : function() {
		this.modelBinder.unbind();
		Backbone.Validation.unbind(this);
		/*this.undelegateEvents();
		this.remove();*/
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
		console.log('ProtView.Core.View: valid function not defined in child element.');
		return this;
	},
	invalid : function() {
		console.log('ProtView.Core.View: invalid function not defined in child element');
		return this;
	},
	submitForm : function(e) {
        e.preventDefault();
        this.controller.save();
        return this;
    },
	render : function() {
		var renderedContent = this.template(this.model.toJSON());
        $(this.el).html(renderedContent);
        this.modelBinder.bind(this.model, this.el, this.bindings);
        Backbone.Validation.bind(this);


		return this;
	},
});