export default function transformer(file, api) {
    const j = api.jscodeshift;
    const root = j(file.source);

    const getFirstNode = () => root.find(j.Program).get('body', 0).node;
    const getSecondNode = () => root.find(j.Program).get('body', 1).node;

    // Save the comments attached to the first node
    const firstNode = getFirstNode();
    const { comments } = firstNode;

    // Save the comments attached to the second node
    const secondNode = getSecondNode();
    const { comments: comments2 } = secondNode;

    // Remove import statements
    root.find(j.ImportDeclaration).remove();

    // Remove named export statements
    root.find(j.ExportNamedDeclaration).remove();

    // Remove export default statements
    root.find(j.ExportDefaultDeclaration).remove();

    // If the first node has been modified or deleted, reattach the comments
    const firstNode2 = getFirstNode();
    if (firstNode2 !== firstNode) {
        firstNode2.comments = comments;
    }

    // If the second node has been modified or deleted, reattach the comments
    const secondNode2 = getSecondNode();
    if (secondNode2 !== secondNode) {
        secondNode2.comments = comments2;
    }

    return root.toSource();
}
