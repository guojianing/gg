new Vue({
    el: '#vote',
    data:{
       liked : false
    },
    methods:{
       toggleLike: function(){
       var pathname = window.location.pathname;
       this.liked = ! this.liked;
       this.$http.get(pathname +'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count)})    
       }
    }
})

var elId = "1" ;
new Vue({
    el: 'body',
    data:{
       liked : false
    },
    
    ready: function() {
        $(".list").mouseenter(function(ev){
	var target = $(ev.target);
    var elid = target.attr('id');
    if( target.is(".list") ) {
    return elId = elid;}
    })
    },
    methods:{
       toggleLike: function(){
       this.liked = ! this.liked;
       this.$http.get('articles/'+elId+'/upvote',function(vote_count) {
       this.$set('vote_count', vote_count)})    
       }
    }
})

