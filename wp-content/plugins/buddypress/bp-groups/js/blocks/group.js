parcelRequire=function(e,r,t,n){var i,o="function"==typeof parcelRequire&&parcelRequire,u="function"==typeof require&&require;function f(t,n){if(!r[t]){if(!e[t]){var i="function"==typeof parcelRequire&&parcelRequire;if(!n&&i)return i(t,!0);if(o)return o(t,!0);if(u&&"string"==typeof t)return u(t);var c=new Error("Cannot find module '"+t+"'");throw c.code="MODULE_NOT_FOUND",c}p.resolve=function(r){return e[t][1][r]||r},p.cache={};var l=r[t]=new f.Module(t);e[t][0].call(l.exports,p,l,l.exports,this)}return r[t].exports;function p(e){return f(p.resolve(e))}}f.isParcelRequire=!0,f.Module=function(e){this.id=e,this.bundle=f,this.exports={}},f.modules=e,f.cache=r,f.parent=o,f.register=function(r,t){e[r]=[function(e,r){r.exports=t},{}]};for(var c=0;c<t.length;c++)try{f(t[c])}catch(e){i||(i=e)}if(t.length){var l=f(t[t.length-1]);"object"==typeof exports&&"undefined"!=typeof module?module.exports=l:"function"==typeof define&&define.amd?define(function(){return l}):n&&(this[n]=l)}if(parcelRequire=f,i)throw i;return f}({"pvse":[function(require,module,exports) {
var e=wp.blocks.registerBlockType,t=wp.element,o=t.createElement,s=t.Fragment,r=wp.components,n=r.Placeholder,i=r.Disabled,l=r.PanelBody,p=r.SelectControl,a=r.ToggleControl,u=r.Toolbar,d=r.ToolbarButton,b=wp.blockEditor,c=b.InspectorControls,g=b.BlockControls,y=wp.data.withSelect,h=wp.compose.compose,m=wp.editor.ServerSideRender,v=wp.i18n.__,C=bp.blockComponents.AutoCompleter,f=[{label:v("None","buddypress"),value:"none"},{label:v("Thumb","buddypress"),value:"thumb"},{label:v("Full","buddypress"),value:"full"}],S=function(e){var t=e.attributes,r=e.setAttributes,b=e.bpSettings,y=b.isAvatarEnabled,h=b.isCoverImageEnabled,S=t.avatarSize,I=t.displayDescription,k=t.displayActionButton,D=t.displayCoverImage;return t.itemID?o(s,null,o(g,null,o(u,null,o(d,{icon:"edit",title:v("Select another group","buddypress"),onClick:function(){r({itemID:0})}}))),o(c,null,o(l,{title:v("Group's home button settings","buddypress"),initialOpen:!0},o(a,{label:v("Display Group's home button","buddypress"),checked:!!k,onChange:function(){r({displayActionButton:!k})},help:v(k?"Include a link to the group's home page under their name.":"Toggle to display a link to the group's home page under their name.","buddypress")})),o(l,{title:v("Description settings","buddypress"),initialOpen:!1},o(a,{label:v("Display group's description","buddypress"),checked:!!I,onChange:function(){r({displayDescription:!I})},help:v(I?"Include the group's description under their name.":"Toggle to display the group's description under their name.","buddypress")})),y&&o(l,{title:v("Avatar settings","buddypress"),initialOpen:!1},o(p,{label:v("Size","buddypress"),value:S,options:f,onChange:function(e){r({avatarSize:e})}})),h&&o(l,{title:v("Cover image settings","buddypress"),initialOpen:!1},o(a,{label:v("Display Cover Image","buddypress"),checked:!!D,onChange:function(){r({displayCoverImage:!D})},help:v(D?"Include the group's cover image over their name.":"Toggle to display the group's cover image over their name.","buddypress")}))),o(i,null,o(m,{block:"bp/group",attributes:t}))):o(n,{icon:"buddicons-groups",label:v("BuddyPress Group","buddypress"),instructions:v("Start typing the name of the group you want to feature into this post.","buddypress")},o(C,{component:"groups",objectStatus:"public",ariaLabel:v("Group's name","buddypress"),placeholder:v("Enter Group's name here…","buddypress"),onSelectItem:r,useAvatar:y}))},I=h([y(function(e){return{bpSettings:e("core/editor").getEditorSettings().bp.groups||{}}})])(S);e("bp/group",{title:v("Group","buddypress"),description:v("BuddyPress Group.","buddypress"),icon:"buddicons-groups",category:"buddypress",attributes:{itemID:{type:"integer",default:0},avatarSize:{type:"string",default:"full"},displayDescription:{type:"boolean",default:!0},displayActionButton:{type:"boolean",default:!0},displayCoverImage:{type:"boolean",default:!0}},edit:I});
},{}]},{},["pvse"], null)