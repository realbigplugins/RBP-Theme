import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { TextControl, PanelBody, ColorPalette, ToggleControl, SelectControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';
import metadata from '../block.json';

import { getColorName } from '../../../../src/assets/js/admin/gutenberg/lib/get-color-name';

registerBlockType( metadata, {
	edit: ( props ) => {
		const {
			attributes: { color, content, url, size, expand, hollow, new_tab, invert, slide_direction },
			setAttributes,
		} = props;
		const blockProps = useBlockProps();

		let cssClass = [
			'button',
			color,
		];

		if ( expand ) {
			cssClass.push( 'expanded' );
		}

		if ( size ) {
			cssClass.push( size );
		}

		if ( hollow ) {
			cssClass.push( 'hollow' );
		}

		if ( invert ) {
			cssClass.push( 'invert' );
		}

		if ( slide_direction ) {
			cssClass.push( 'slide-' + slide_direction );
		}

		return (

			<div { ...blockProps }>

				<InspectorControls key="setting">
					<PanelBody
						title={ rbpBlocks.rbpButton.buttonColor.label }>
						<ColorPalette
							value={ color }
							colors={ rbpBlocks.rbpButton.buttonColor.colors }
							disableCustomColors="true"
							onChange={ function( nextButtonColor ) {
								setAttributes( {
									color: getColorName( nextButtonColor, rbpBlocks.rbpButton.buttonColor.colors )
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.buttonURL.label }>
						<TextControl 
							value={ url }
							onChange={ function( nextURL ) {
								setAttributes( {
									url: nextURL
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.newTab.label }>
						<ToggleControl
							checked={ new_tab }
							onChange={ function( nextNewTab ) {
								setAttributes( {
									new_tab: nextNewTab
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.buttonSize.label }>
						<SelectControl
							value={ size }
							options={ rbpBlocks.rbpButton.buttonSize.options }
							onChange={ function( nextButtonSize ) {
								setAttributes( {
									size: nextButtonSize
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.expand.label }>
						<ToggleControl
							checked={ expand }
							onChange={ function( nextExpand ) {
								setAttributes( {
									expand: nextExpand
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.hollow.label }>
						<ToggleControl
							checked={ hollow }
							onChange={ function( nextHollow ) {
								setAttributes( {
									hollow: nextHollow
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.invert.label }>
						<ToggleControl
							checked={ invert }
							onChange={ function( nextInvert ) {
								setAttributes( {
									invert: nextInvert
								} )
							} }
						/>
					</PanelBody>
					<PanelBody
						title={ rbpBlocks.rbpButton.slideDirection.label }>
						<SelectControl
							value={ slide_direction }
							options={ rbpBlocks.rbpButton.slideDirection.options }
							onChange={ function( nextSlideDirection ) {
								setAttributes( {
									slide_direction: nextSlideDirection
								} )
							} }
						/>
					</PanelBody>
				</InspectorControls>

				<button class={ cssClass.join( ' ' ) }>
					<RichText 
						tagName="span"
						placeholder={ rbpBlocks.rbpButton.content.placeholder }
						className="button-text"
						value={ content }
						onChange={ function( nextContent ) {
							setAttributes( {
								content: nextContent
							} )
						} }
					/>
				</button>
				
			</div>
		);
	}
} );

( function( $ ) {

	// Use only our own
	//  https://github.com/WordPress/gutenberg/issues/11723#issuecomment-439628591
	$( window ).on( 'load', function() {
		wp.blocks.unregisterBlockType( 'core/button' );
		wp.blocks.unregisterBlockType( 'core/buttons' );
	} );

} )( jQuery );