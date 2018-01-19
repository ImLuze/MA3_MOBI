const path = require(`path`);
const webpack = require(`webpack`);

const PATHS = {
  src: path.join(__dirname, `src`),
  dist: path.join(__dirname, `dist`),
};
const merge = require(`webpack-merge`);
const parts = require(`./webpack.parts.js`);

const commonConfig = merge([ {
  entry: [
    path.join(PATHS.src, `css/style.css`),
    path.join(PATHS.src, `js/script.js`),
  ],
  devtool: `sourcemap`,
  devServer: {
    contentBase: `./src`,
    historyApiFallback: true,
    hot: true,
    port: 3000,
  },
  output: {
    path: PATHS.dist,
    filename: `js/script.js`,
  },
  module: {
    rules: [
      {
        test: /\.(js)$/,
        exclude: /node_modules/,
        use: [{
          loader: `babel-loader`,
        },
        {
          loader: `eslint-loader`,
          options: {
            fix: true,
          },
        }],
      }, {
        test: /\.html$/,
        loader: `html-loader`,
      }, {
        test: /\.jpe?g$/,
        loader: `url-loader`,
        options: {
          limit: 1000,
          context: `./src`,
          name: `[path][name].[ext]`,
        },
      }],
  },
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new webpack.ProvidePlugin({
      Promise: `es6-promise`,
      fetch: `imports-loader?this=>global!exports-loader?global.fetch!whatwg-fetch`,
    }),
  ],
}]);

const productionConfig = merge([
  parts.extractCSS(),
]);
const developmentConfig = merge([
  {
    devServer: { overlay: true },
  },
  parts.loadCSS(),
]);

if(process.env.NODE_ENV === `production`){
  console.log(`Building production`);
  module.exports = merge(commonConfig, productionConfig);
}else{
  module.exports = merge(commonConfig, developmentConfig);
}
