jQuery(document).ready(function(){var e=jqnc(),h=false,k=e("#same-shipping"),l=e("#submit-login-checkout"),f=e("#account-login-checkout"),b=e("#password-login-checkout"),j=e("#checkout.shopp"),i=e("#shipping-address-fields"),g=e("#billing-address-fields"),d=e("#checkout.shopp [name=paymethod]"),a=e("#billing-locale"),c=e("#checkout.shopp li.locale");if(a.children().size()==0){c.hide()}if(k.length>0){k.change(function(){if(k.attr("checked")){g.removeClass("half");i.hide().find(".required").attr("disabled",true)}else{g.addClass("half");i.show().find("input, select").not("#shipping-xaddress, .unavailable").attr("disabled",false)}}).change();k.click(function(){e(this).change()})}l.click(function(){h=true});j.unbind("submit").submit(function(){if(h){h=false;if(f.val()==""){alert(ShoppSettings.LOGIN_NAME_REQUIRED);f.focus();return false}if(b.val()==""){alert(ShoppSettings.LOGIN_PASSWORD_REQUIRED);b.focus();return false}e("#process-login").val("true");return true}if(validate(this)){return true}else{return false}});e("#shipping-country").change(function(){if(e("#shipping-state").attr("type")=="text"){return true}e("#shipping-state").empty().attr("disabled",true).addClass("unavailable disabled");e("<option></option>").val("").html("").appendTo("#shipping-state");if(regions[this.value]){e.each(regions[this.value],function(n,m){option=e("<option></option>").val(n).html(m).appendTo("#shipping-state")});e("#shipping-state").attr("disabled",false).removeClass("unavailable disabled")}});e("#billing-country").change(function(){if(e("#billing-state").attr("type")=="text"){return true}e("#billing-state").empty().attr("disabled",true).addClass("unavailable disabled");e("<option></option>").val("").html("").appendTo("#billing-state");if(regions[this.value]){e.each(regions[this.value],function(n,m){option=e("<option></option>").val(n).html(m).appendTo("#billing-state")});e("#billing-state").attr("disabled",false).removeClass("unavailable disabled")}});e("#billing-country, #billing-state").change(function(){var o=e("#billing-country").val(),n=e("#billing-state").val(),p=o+n,m;if(!a.get(0)){return}a.empty().attr("disabled",true);if(locales[p]){e.each(locales[p],function(r,q){m+='<option value="'+q+'">'+q+"</option>"});e(m).appendTo(a);a.removeAttr("disabled");c.show()}});e(".shopp .shipmethod").change(function(){if(e(this).parents("#checkout").size()){e(".shopp_cart_shipping, .shopp_cart_tax, .shopp_cart_total").html("?");e.getJSON(ShoppSettings.ajaxurl+"?action=shopp_shipping_costs&method="+e(this).val(),function(m){var n="span.shopp_cart_";e(n+"shipping").html(asMoney(new Number(m.shipping)));e(n+"tax").html(asMoney(new Number(m.tax)));e(n+"total").html(asMoney(new Number(m.total)))})}else{e(this).parents("form").submit()}});d.change(function(){var n=e(this).val();e(document).trigger("shopp_paymethod",[n]);if(ccpayments[n]!=false&&ccpayments[n].length>0){e("#checkout.shopp .payment").show();e("#checkout.shopp .creditcard").show();e("#checkout.shopp .creditcard.disabled").attr("disabled",false).removeClass("disabled");e("#checkout.shopp #billing-cardtype").empty().attr("disabled",false).removeClass("disabled");var m='<option value="" selected="selected"></option>';e.each(ccpayments[n],function(p,o){e.each(ccallowed[n],function(r,q){if(o.symbol==q){m+='<option value="'+o.symbol+'">'+o.name+"</option>"}})});e(m).appendTo("#checkout.shopp #billing-cardtype")}else{e("#checkout.shopp .payment").hide();e("#checkout.shopp .creditcard").hide();e("#checkout.shopp .creditcard").addClass("disabled").attr("disabled",true);e("#checkout.shopp #billing-cardtype").addClass("disabled").attr("disabled",true)}}).change().change(function(){var m=e(this).val();e.post(ShoppSettings.ajaxurl,{action:"shopp_checkout_submit_button",paymethod:m},function(n){if(n!=null){e("#checkout.shopp p.submit").html(n)}})});e(window).load(function(){e(document).trigger("shopp_paymethod",[d.val()])})});