<style>
    .cate {
        box-shadow: 1px 1px 1px #e4e4e4;
        padding: 3px 3px;
    }

    .cate:hover {
        box-shadow: 1px 1px 2px #c1c0c0;
    }

    .menu {
        /* width: 300px; */
        margin: auto;
    }

    .tree {
        list-style: none;
        padding-left: 20px;
        position: relative;
        color: rgb(48, 48, 48);
    }

    .branch {
        padding-right: 50%;
        cursor: pointer;
    }

    .tree ul li span {
        padding: 5px 0;
    }

    .tree:before {
        content: '';
        width: 1px;
        background: rgb(36, 36, 36);
        top: 0;
        bottom: 7px;
        left: 0;
        position: absolute;
    }

    .tree li {
        position: relative;
        margin: 5px 0;
        padding: 5px 0;
        width: 100%;
    }

    .tree li:hover,
    .tree li:focus {
        color: #000000;
    }

    .tree li:before {
        content: '';
        width: 20px;
        height: 1px;
        background: rgb(105, 105, 105);
        top: 15px;
        left: -20px;
        position: absolute;
    }

    .tree .tree {
        display: none;
    }
</style>
