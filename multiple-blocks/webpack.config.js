/**
 * Customize wp-scripts Webpack configuration to enable the use of a single
 * runtime chunk in hot-reloading mode. This allows multiple bundles to hot-
 * reload in an intuitive manner, so that we can work on multiple blocks and
 * theme scripts at once from the same HMR devServer.
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

module.exports = defaultConfig;

if (
	process.env.WEBPACK_SERVE === 'true' &&
	process.argv.includes( '--hot' )
) {
	// Running in hot-reloading mode: customize the exported configuration
	// to set a single runtime chunk (necessary for HMR to work across multiple
	// block / theme bundles at once) and allow devServer access from all hosts.
	// This allows HMR to work while running the site in Altis Local Server.
	module.exports = {
		...defaultConfig,
		devServer: {
			...( defaultConfig.devServer || {} ),
			allowedHosts: 'all',
		},
		optimization: {
			...( defaultConfig.optimization || {} ),
			runtimeChunk: 'single',
		},
	};
}
