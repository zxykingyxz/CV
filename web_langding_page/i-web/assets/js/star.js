

/*
* plugin comment star
* author: nguyễn hoàng nam
* modify 04/09/2021
*/
(function($){
	
	$.fn.commentStar=function(options){

		var self = this;

		var defaults={
			rating: void 0,
			max: 5,
			readOnly: false,
			emptyClass:'fa fa-star',
			selectedClass:'selected fa fa-star',
			countSelected:0,
			complete:null

		}

		var settings=$.extend({},defaults,options);

		self.init=function(){

			self._createElement();
			self._selected();

		}

		self.on('mouseover','a',function(e){

			return self._syncRating(self._getStars().index(e.currentTarget)+1);

		});

		self.on('mouseout','a',function(e){

			// return self._setRating(settings.countSelected);

			return self._syncRating();

		});

		self.on('click','a',function(e){

			e.preventDefault();

			var rating=self._getStars().index(e.currentTarget)+1;

			if($.isFunction(settings.complete)){

				settings.complete.call(self,rating);

			}
			
			return self._setRating(rating);



		});

		self._setRating=function(rating){

			if(settings.rating===rating){

				rating=void 0;

			}

			settings.rating=rating;

			self._syncRating();

			// return self.trigger('complete',rating);

		}

		self._getRating=function(){

			return settings.rating;

		}

		self._getStars=function(){

			return self.find('a');

		}

		self._syncRating=function(rating){

			var $stars, i, j, ref, results;

			rating || (rating = settings.rating);

			$star=this._getStars();

			results=[];

			for (i = j = 1, ref = settings.max; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j){
					
				results.push($star.eq(i-1).removeClass(rating>=i ? settings.emptyClass : settings.selectedClass).addClass(rating>=i ? settings.selectedClass : settings.emptyClass))

			}

			return results;

		}

		self._selected=function(){
				
			for (j = 1, c = settings.countSelected; j<=c ;j++) {

				this._getStars().eq(j-1).addClass('selected');

			}

		}

		self._createElement=function(){

			var j,result;

			result=[];

			for (j = 1, ref = settings.max; 1 <= ref ? j <= ref : j >= ref; 1 <= ref ? j++ : j--) {

				result.push(self.append('<a href="#" class="'+settings.emptyClass+'">'));

			}

		}
		return this.each(function(){
			self.init();
		});

	}
}(jQuery));

