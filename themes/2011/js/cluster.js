
var Cluster = Class.create( {
		cCapCount: 0,
		nCapWidth: 0,
		
		nCurCap: 0,
		bInScroll: false,
		bSuppressScrolling: false,
		rgImages: Array(),
		rgImageURLs: {},
		nCapsulesToPreload: 1,
		
		initialize: function( args )
		{
			this.cCapCount = args.cCapCount;
			this.nCapWidth = args.nCapWidth;
			this.nCapsulesToPreload = args.nCapsulesToPreload || 1;
			
			this.elClusterArea = args.elClusterArea;
			this.elScrollArea = args.elScrollArea || this.elClusterArea.down('.cluster_scroll_area');
			this.elScrollLeftBtn = args.elScrollLeftBtn || this.elClusterArea.down('.cluster_control_left');
			this.elScrollRightBtn = args.elScrollRightBtn  || this.elClusterArea.down('.cluster_control_right');
			
			this.rgImages = args.rgImages || this.elClusterArea.select( 'img.cluster_capsule_image' );
			this.rgImageURLs = args.rgImageURLs || {};
			
			this.elSlider = args.elSlider;
			var elHandle = args.elHandle || this.elSlider.down('.handle');
			
			this.elScrollLeftBtn.observe( 'click', this.scrollLeft.bindAsEventListener( this ) );
			this.elScrollRightBtn.observe( 'click', this.scrollRight.bindAsEventListener( this, false ) );

			this.elClusterArea.observe( 'mouseover', this.mouseOver.bindAsEventListener( this ) );
			this.elClusterArea.observe( 'mouseout', this.mouseOut.bindAsEventListener( this ) );

			// put this in a closure
			var obj = this;
			//Event.observe( window, 'focus', function() { obj.bSuppressScrolling = false; } );
			//Event.observe( window, 'blur', function() { obj.bSuppressScrolling = true; }  );

			this.slider = new Control.Slider( elHandle, this.elSlider, {
		        range: $R(0, this.nCapWidth * this.cCapCount ),
		        sliderValue: 0,
		        onSlide: this.sliderOnSlide.bind( this ),
		        onChange: this.sliderOnChange.bind( this )
	     	});
	     	
	     	Event.observe( window, 'load', this.startTimer.bind( this ) );
		},

		startTimer: function()
		{
			this.clearInterval();
			this.interval = window.setInterval( this.scrollRight.bindAsEventListener( this, true ), 5000 );
		},

		clearInterval: function()
		{
			if ( this.interval )
			{
				window.clearInterval( this.interval );
				this.interval = false;
			}
		},

		mouseOver: function()
		{
			this.clearInterval();
			ShowWithFade( this.elScrollLeftBtn );
			ShowWithFade( this.elScrollRightBtn );
		},

		mouseOut: function( event )
		{
	    	var reltarget = (event.relatedTarget) ? event.relatedTarget : event.toElement;
	    	if ( reltarget && $(reltarget).up( '#' + this.elClusterArea.id ) )
	    		return;

    		HideWithFade( this.elScrollLeftBtn );
    		HideWithFade( this.elScrollRightBtn );
    		this.startTimer();
		},
		
		scrollRight: function( event, bAutoScroll )
		{
			if ( this.bSuppressScrolling && bAutoScroll )
				return;
			this.nCurCap++;
			this.bInScroll = true;
			var nDuration = bAutoScroll ? 0.4 : 0.4;
			if ( this.nCurCap <= this.cCapCount )
			{
				if ( this.elScrollArea.effect ) this.elScrollArea.effect.cancel();
				this.elScrollArea.effect = new Effect.Morph( this.elScrollArea, { style: 'left: -' + (this.nCurCap * this.nCapWidth) + 'px;', duration: nDuration, fps: 60 } );
			}
			else
			{							
				this.nCurCap = 0;
				if ( this.elScrollArea.effect ) this.elScrollArea.effect.cancel();
				var elScrollArea = this.elScrollArea;
				this.elScrollArea.effect = new Effect.Morph( this.elScrollArea, { style: 'left: -' + ( (this.cCapCount + 1 ) * this.nCapWidth) + 'px;', duration: nDuration, fps: 60, afterFinish: function() { elScrollArea.style.left = '0px'; } } );
			}
			this.slider.setValue( this.nCurCap * this.nCapWidth );
			this.ensureImagesLoaded();
			this.bInScroll = false;
		},
		
		scrollLeft: function()
		{
			this.nCurCap--;
			this.bInScroll = true;
			if ( this.nCurCap >= 0 )
			{
				if ( this.elScrollArea.effect ) this.elScrollArea.effect.cancel();
				this.elScrollArea.effect = new Effect.Morph( this.elScrollArea, { style: 'left: -' + (this.nCurCap * this.nCapWidth) + 'px;', duration: 0.4 } );
			}
			else
			{							
				this.nCurCap = this.cCapCount;
				if ( this.elScrollArea.effect ) this.elScrollArea.effect.cancel();
				this.elScrollArea.style.left = '-' + ( ( this.cCapCount + 1 ) * this.nCapWidth ) + 'px';
				this.elScrollArea.effect = new Effect.Morph( this.elScrollArea, { style: 'left: -' + ( this.cCapCount * this.nCapWidth) + 'px;', duration: 0.4 } );
			}
			this.slider.setValue( this.nCurCap * this.nCapWidth );
			this.ensureImagesLoaded();
			this.bInScroll = false;
		},
		
		sliderOnSlide: function( value )
		{
			this.nCurCap = Math.round( value / this.nCapWidth );
			this.ensureImagesLoaded();
			
        	if ( this.elScrollArea.effect ) this.elScrollArea.effect.cancel();
        	this.elScrollArea.style.left = '-' + value + 'px';
		},
		
		sliderOnChange: function( value )
		{
			if ( !this.bInScroll )
			{
				this.nCurCap = Math.round( value / this.nCapWidth );
		        var nSnapValue = this.nCurCap * this.nCapWidth;
		        if ( nSnapValue != value )
		        {
		        	this.slider.setValue( nSnapValue );
		        	var nTravelDist = Math.abs( nSnapValue + parseInt( this.elScrollArea.style.left ) );
		        	this.elScrollArea.effect = new Effect.Morph( this.elScrollArea, {style: 'left: -' + nSnapValue + 'px;', duration: Math.max( 0.2, nTravelDist / 2500 ) } );
		        }
			}
		},

		ensureImagesLoaded: function()
		{
			for ( var i = 0; i <= this.nCapsulesToPreload && this.nCurCap + i < this.rgImages.length; i++ )
			{
				var img = this.rgImages[ this.nCurCap + i ];
				if ( this.rgImageURLs[ img.id ] && img.src != this.rgImageURLs[ img.id ] )
					img.src = this.rgImageURLs[ img.id ];
			}
		}
	} );



