export default function transformer(file, api) {
    const j = api.jscodeshift;
    const root = j(file.source);

    // Remove import statements
    root.find(j.ImportDeclaration).remove();

    // Remove named export statements
    root.find(j.ExportNamedDeclaration).remove();

    // Remove export default statements
    root.find(j.ExportDefaultDeclaration).remove();

    return root.toSource();
}
