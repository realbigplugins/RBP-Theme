!function(){"use strict";!function(){var e=window.wp.element,t=window.wp.blocks,o=window.wp.blockEditor,n=window.wp.components,l=(window.wp.serverSideRender,JSON.parse('{"$schema":"https://json.schemastore.org/block.json","apiVersion":2,"name":"rbp/rbp-button","version":"0.1.0","title":"RBP Button","category":"design","icon":"button","description":"RBP styled Buttons","keywords":["rbp","button"],"attributes":{"url":{"type":"string","default":null},"content":{"type":"string","default":""},"new_tab":{"type":"boolean","default":false},"color":{"type":"string","default":"secondary"},"size":{"type":"string","default":""},"expand":{"type":"boolean","default":false},"hollow":{"type":"boolean","default":false},"invert":{"type":"boolean","default":false},"slide_direction":{"type":"string","default":""}},"supports":{"align":["left","center","right"],"html":false},"textdomain":"rbp-sportswear-theme","editorScript":"rbp-button","editorStyle":"rbp-button"}'));function r(e,t){return void 0!==(t=t.filter((function(t){return t.color==e})))[0]&&t[0].name}(0,t.registerBlockType)(l,{edit:t=>{const{attributes:{color:l,content:a,url:c,size:i,expand:s,hollow:u,new_tab:p,invert:b,slide_direction:d},setAttributes:B}=t,g=(0,o.useBlockProps)();let h=["button",l];return s&&h.push("expanded"),i&&h.push(i),u&&h.push("hollow"),b&&h.push("invert"),d&&h.push("slide-"+d),(0,e.createElement)("div",g,(0,e.createElement)(o.InspectorControls,{key:"setting"},(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.buttonColor.label},(0,e.createElement)(n.ColorPalette,{value:l,colors:rbpBlocks.rbpButton.buttonColor.colors,disableCustomColors:"true",onChange:function(e){B({color:r(e,rbpBlocks.rbpButton.buttonColor.colors)})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.buttonURL.label},(0,e.createElement)(n.TextControl,{value:c,onChange:function(e){B({url:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.newTab.label},(0,e.createElement)(n.ToggleControl,{checked:p,onChange:function(e){B({new_tab:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.buttonSize.label},(0,e.createElement)(n.SelectControl,{value:i,options:rbpBlocks.rbpButton.buttonSize.options,onChange:function(e){B({size:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.expand.label},(0,e.createElement)(n.ToggleControl,{checked:s,onChange:function(e){B({expand:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.hollow.label},(0,e.createElement)(n.ToggleControl,{checked:u,onChange:function(e){B({hollow:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.invert.label},(0,e.createElement)(n.ToggleControl,{checked:b,onChange:function(e){B({invert:e})}})),(0,e.createElement)(n.PanelBody,{title:rbpBlocks.rbpButton.slideDirection.label},(0,e.createElement)(n.SelectControl,{value:d,options:rbpBlocks.rbpButton.slideDirection.options,onChange:function(e){B({slide_direction:e})}}))),(0,e.createElement)("button",{class:h.join(" ")},(0,e.createElement)(o.RichText,{tagName:"span",placeholder:rbpBlocks.rbpButton.content.placeholder,className:"button-text",value:a,onChange:function(e){B({content:e})}})))}}),jQuery(window).on("load",(function(){wp.blocks.unregisterBlockType("core/button"),wp.blocks.unregisterBlockType("core/buttons")}))}()}();