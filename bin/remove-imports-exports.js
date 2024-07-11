export default function transformer(file, api) {
    const j = api.jscodeshift;
    const root = j(file.source);

    const getFirstNodesAndComments = () => {
        const program = root.find(j.Program);
        const firstNode = program.get('body', 0).node;
        const secondNode = program.get('body', 1).node;
        const { comments: firstNodeComments } = firstNode;
        const { comments: secondNodeComments } = secondNode;
        return { firstNode, firstNodeComments, secondNode, secondNodeComments };
    };

    // Save the comments attached to the first and second nodes
    const { firstNode, firstNodeComments, secondNode, secondNodeComments } =
        getFirstNodesAndComments();

    // Remove import statements
    root.find(j.ImportDeclaration).remove();

    // Remove named export statements
    root.find(j.ExportNamedDeclaration).remove();

    // Remove export default statements
    root.find(j.ExportDefaultDeclaration).remove();

    // If the first or second node has been modified or deleted, reattach the original comments
    const { firstNode: newFirstNode, secondNode: newSecondNode } =
        getFirstNodesAndComments();
    if (newFirstNode !== firstNode) {
        newFirstNode.comments = firstNodeComments;
    }
    if (newSecondNode !== secondNode) {
        newSecondNode.comments = secondNodeComments;
    }

    return root.toSource();
}
