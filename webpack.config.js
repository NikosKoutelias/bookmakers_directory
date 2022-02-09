const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
module.exports = {
    // mode: "production",
    context: path.resolve(__dirname, "assets"),
    entry: {
        "front/main": "./front/main.js",
        "admin/index": "./admin/index.js"
    },
    output: {
        filename: "[name].js",
        path: path.resolve(__dirname, "Source/bookmakers_directory/dist")
    },
    
    plugins: [
        new MiniCssExtractPlugin(),
    ],
    module: {
        rules: [
            {
                test: /\.s[ac]ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            importLoaders: 1
                        }
                    },
                    {
                        loader: "postcss-loader",
                        options: {
                            postcssOptions: {
                                plugins: [
                                    "autoprefixer"
                                ]
                            }
                        }
                    },
                    {
                        loader: "sass-loader",
                        options: {
                            implementation: require("sass"),
                            sourceMap:  true,
                        }
                    }
                ]
            },
        ]
    }
}