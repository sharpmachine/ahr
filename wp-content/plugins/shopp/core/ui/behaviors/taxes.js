/*
 * taxes.js - Tax rate settings behaviors
 * Copyright ?? 2008-2010 by Ingenesis Limited
 * Licensed under the GPLv3 {@see license.txt}
 */
function TaxRate(A){var g=jqnc(),u=ratesidx++,p=0,x=g("#tax-rates"),w='<select name="settings[taxrates]['+u+'][logic]"><option value="any">'+ANY_OPTION+'</option><option value="all">'+ALL_OPTION+"</option></select>",t='<th scope="row" valign="top"><p><input type="text" name="settings[taxrates]['+u+'][rate]" value="" size="6" class="selectall" /></p></th><td><div class="controls"></div><ul class="conditions"><li class="origin"><select name="settings[taxrates]['+u+'][country]" class="country"></select><select name="settings[taxrates]['+u+'][zone]" class="zone"></select></li><li class="scope"><p>'+APPLY_LOGIC.replace("%s",w)+":</p></li></ul></td>",j=g("<tr/>").html(t).appendTo(x),z=j.find("th p input"),s=j.find("div.controls"),l=j.find("td ul.conditions"),y=l.find("li.origin"),d=l.find("li.scope").hide(),e=l.find("select.country"),n=l.find("select.zone"),a=false,v=false,m=g('<label><input type="checkbox" name="settings[taxrates]['+u+'][localrates]" value="on" /> '+LOCAL_RATES+"</label>").appendTo(s),k='<button type="button" class="add"><img src="'+SHOPP_PLUGINURI+'/core/ui/icons/add.png" alt="+" width="16" height="16" /></button>',q='<button type="button" class="delete"><img src="'+SHOPP_PLUGINURI+'/core/ui/icons/delete.png" alt="-" width="16" height="16" /></button>',i=g(q).appendTo(s),B="";g.each(countries,function(D,C){B+='<option value="'+D+'">'+C+"</option>"});e.html(B).change(function(){var D=g(this);if(!v){v=D.val()}if(g.inArray(v,countriesInUse)!=-1){countriesInUse.splice(g.inArray(v,countriesInUse),1)}v=D.val();if(!zones[v]){countriesInUse.push(v)}n.hide().empty();if(zones[v]){var C=false;g.each(zones[g(e).val()],function(F,E){if(g.inArray(F,zonesInUse)!=-1){option=g("<option></option>").attr("disabled",true).val(F).html(E).appendTo(n)}else{option=g("<option></option>").val(F).html(E).appendTo(n)}if(C){C=false;option.attr("selected",true)}if(option.attr("selected")&&option.attr("disabled")){C=true}});if(C){allCountryZonesInUse.push(g(e).val());e.attr("selectedIndex",e.attr("selectedIndex")+1).change()}}if(n.children().length==0){n.hide()}else{n.show()}n.change()}).change();z.change(function(){this.value=asPercent(this.value,false,3,true)}).change();j.dequeue().hover(function(){s.show()},function(){s.fadeOut("fast")});i.click(function(){j.fadeOut("fast",function(){j.remove()})});m.change(function(){b((A.locals?A.locals:false))});new h(y);quickSelects();o(A);function c(I,J){var D=p++,G='<li><select name="settings[taxrates]['+u+"][rules]["+D+'][p]" class="property"></select>&nbsp;<input type="text" name="settings[taxrates]['+u+"][rules]["+D+'][v]" size="25" class="value" /></li>',H=g(G),F=H.find("select.property"),E=H.find("input.value"),C="";g.each(RULE_LANG,function(L,K){C+='<option value="'+L+'">'+K+"</option>"});F.html(C);if(J){if(J.p){F.val(J.p)}if(J.v){E.val(J.v)}}F.change(function(){E.unbind("keydown").unbind("keypress").suggest(sugg_url+"&action=shopp_suggestions&t="+g(this).val(),{delay:500,minchars:2})}).change();new f(H);new h(H);if(I==y){d.show();H.appendTo(l);return}if(I){H.insertAfter(I)}else{H.appendTo(l)}}function b(F){var J,C,I,D,G,K,H;src='<div class="local-rates"><div class="label"><label>'+LOCAL_RATES+' <span class="counter"></span><input type="hidden" name="settings[taxrates]['+u+'][locals]" value="" /></label><button type="button" name="toggle" class="toggle">&nbsp;</button></div><div class="ui"><p>'+LOCAL_RATE_INSTRUCTIONS+'</p><ul></ul><button type="button" name="upload" class="button-secondary">Upload</button></div>',panel=y.find("div.local-rates");if(!panel.get(0)){panel=g(src).appendTo(y)}else{panel.toggle()}I=panel.find("div.ui");J=panel.find("div.label");toggle=J.find("button.toggle");J.unbind("click").click(function(){I.slideToggle("fast");toggle.trigger("toggle.clicked")});C=J.find("span.counter");D=I.find("p");G=I.find("ul");K=I.find("button");toggle.bind("toggle.clicked",function(){var P=g(this),N=20,L=180;function M(){H+=N;P.css("background-position",H+"px top");if(H<0){setTimeout(M,20)}else{P.css("background-position",null).removeClass("closed")}}function O(){H-=N;P.css("background-position",H+"px top");if(Math.abs(H)<L){setTimeout(O,20)}else{P.css("background-position",null).addClass("closed")}}if(H<0){return setTimeout(M,20)}else{return setTimeout(O,20)}});n.change(function(){var L=false;if(localities[e.val()]&&localities[e.val()][g(this).val()]){L=localities[e.val()][g(this).val()]}E(L)});K.upload({name:"shopp",action:upload_url,params:{action:"shopp_upload_local_taxes"},onSubmit:function(){K.attr("disabled",true).addClass("updating").parent().css("width","100%")},onComplete:function(M){K.removeAttr("disabled").removeClass("updating");try{r=g.parseJSON(M);if(r.error){alert(r.error)}else{E(r)}}catch(L){alert(LOCAL_RATES_UPLOADERR)}}});if(F){I.hide();H=-180;toggle.addClass("closed");E(F)}function E(N){var L="",M=0;G.html("");C.html("");if(!N){return D.show()}else{D.hide()}g.each(N,function(P,Q){var O=P,R=Q;if(N instanceof Array){O=Q,R=0}L+='<li><label><input type="text" name="settings[taxrates]['+u+"][locals]["+O+']" size="6" value="'+R+'" /> '+O+"</label></li>";M++});G.html(L).find("input").focus(function(){this.select()}).change(function(){this.value=asPercent(this.value,false,3,true);g(this).attr("title",asPercent(asNumber(this.value)+asNumber(z.val()),false,3,true))}).change();C.html("("+M+")")}}function f(D){var C=g(q).prependTo(D).click(function(){if(l.find("li").size()==3){d.hide()}D.fadeOut("fast",function(){D.remove()})});D.hover(function(){C.css("opacity",1)},function(){C.animate({opacity:0},"fast")})}function h(C){g(k).appendTo(C).click(function(){new c(C)})}function o(C){if(C.rate){z.val(C.rate).change()}if(C.country){e.val(C.country).change()}if(C.zone){n.val(C.zone).change()}if(C.logic){d.find("select").val(C.logic).change()}if(C.localrates&&C.localrates=="on"){m.find("input").attr("checked",true).change()}if(C.rules){g.each(C.rules,function(E,D){new c(y,D)})}}}jQuery(document).ready(function(){var a=jqnc();if(!ratetable.get(0)){return}a("#add-taxrate").click(function(){new TaxRate()});ratetable.empty();if(rates){a(rates).each(function(){new TaxRate(this)})}else{new TaxRate()}});