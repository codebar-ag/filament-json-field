import * as esbuild from 'esbuild';

esbuild.build({
    entryPoints: ['./resources/js/codemirror.js'],
    outfile: './dist/codemirror.js',
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'browser',
    treeShaking: true,
    target: ['es2020'],
    minify: true,
});
