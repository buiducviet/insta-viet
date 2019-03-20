export default {
    install: (Vue) => {
        Vue.prototype.$helper = {
            str_slug(slug){
                if (typeof slug !== 'string') {
                    return slug;
                }
                return slug.toString().toLowerCase()
                    .replace(/\s+/g, '-')           // Replace spaces with -
                    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                    .replace(/^-+/, '')             // Trim - from start of text
                    .replace(/-+$/, '');
            },
            media(url){
                if (!url || url == null || url.lastIndexOf('.') < 1) {
                    return '/static/img/no_img.jpg';
                }else if ( typeof url == 'string' && url.indexOf('://') < 0) {
                    url = Laravel.media+url;
                }
                return url;
            },
            route(name, param = false){
                var route = Laravel.routes[name];
                if (!param && !route.indexOf('}')) {
                    return route;
                }
                if (typeof param == 'string') {
                    param = [param];
                }
                for (var i = 0; i < param.length; i++) {
                    route = route.replace(route.substr(route.indexOf('{'), route.indexOf('}')), param[i]);
                }
                return route;
            },
            post_route(post, length = 80){
                var string = post.caption;
                if (string.length >= length) {
                    string = string.substr(0, length);
                }
                string = this.str_slug(string);
                if (string.length == 0) {
                    string = Laravel.domain.name;
                }

                string += '-p-'+post.shortCode;
                return this.route('post', string);
            },
            caption_decode(caption, length = 100){
                if (caption.length >= length) {
                    caption = caption.substring(0, caption.indexOf(' ', length - 1));
                }
                if (caption.indexOf('#') > -1) {
                    var arr = caption.split('#');
                    var string = '';
                    for (var i = 0; i < arr.length; i++) {
                        var tag = arr[i];
                        if (i > 0) {
                            if (tag.indexOf(' ')) {
                                var wrap = tag.split(' ');
                                wrap[0] = '<a href="'+this.route('tag', wrap[0])+'">#'+wrap[0]+'</a>';
                                tag = wrap.join(' ');
                            }else{
                                tag = '<a href="'+this.route('tag', tag)+'">#'+tag+'</a>';
                            }
                        }
                        string += tag;
                    }
                    caption = string;
                }
                return caption;
            },
            numberToString($num){
                var $str = $num+'';
                var $ex = '';
                if ($str.length > 9) {
                    $num = $num/1000000000;
                    $ex = 'b';
                }else if($str.length > 6){
                    $num = $num/1000000;
                    $ex = 'm';
                }else if ($str.length > 3) {
                    $num = $num/1000;
                    $ex = 'k';
                }
                if ($ex.length) {
                    if (!Number.isInteger($num)) {
                        $str = Number.parseFloat($num).toFixed(2);
                    }
                    $str += $ex;
                }
                return $str;
            }
        }
    }
};