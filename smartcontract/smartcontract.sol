pragma solidity ^0.6.0;
pragma experimental ABIEncoderV2;


contract SupplyChain {
    
    event Added(uint256 index);
    
    struct State{
        string description;
        address person;
    }
    
    struct Product{
        address creator;
        string productName;
        string prodgrd;
        string prodtype;
        string prodlife;
        string packsize;
        string prodqnt;
        string manuname;
        string avail;
        uint256 productId;
        string date;
        string cntno;
        uint256 totalStates;
        mapping (uint256 => State) positions;
    }
    
    mapping(uint => Product) allProducts;
    uint256 items=0;
    uint[] rem = new uint[](100);     
    uint256 remcnt=0;


    function uint2str(uint _i) internal pure returns (string memory _uintAsString) {
        if (_i == 0) {
            return "0";
        }
        uint j = _i;
        uint len;
        while (j != 0) {
            len++;
            j /= 10;
        }
        bytes memory bstr = new bytes(len);
        uint k = len - 1;
        while (_i != 0) {
            bstr[k--] = byte(uint8(48 + _i % 10));
            _i /= 10;
        }
        return string(bstr);
    }

    function concat(string memory _a, string memory _b) public returns (string memory){
        bytes memory bytes_a = bytes(_a);
        bytes memory bytes_b = bytes(_b);
        string memory length_ab = new string(bytes_a.length + bytes_b.length);
        bytes memory bytes_c = bytes(length_ab);
        uint k = 0;
        for (uint i = 0; i < bytes_a.length; i++) bytes_c[k++] = bytes_a[i];
        for (uint i = 0; i < bytes_b.length; i++) bytes_c[k++] = bytes_b[i];
        return string(bytes_c);
    }
    
    function newItem(string memory _prodname, string memory _prodgrd, string memory _type, string memory _prodlife, string memory _packsize, string memory _prodqnt, string memory _manuname, string memory _avail, string memory _cntno, string memory _date) public returns (bool) {
        Product memory newItem = Product({creator: msg.sender, totalStates: 0,productName: _prodname, prodgrd: _prodgrd, 
        prodtype: _type, prodlife: _prodlife, packsize: _packsize, prodqnt: _prodqnt, manuname: _manuname, avail: _avail, cntno: _cntno, productId: items, date: _date});
        allProducts[items]=newItem;
        items = items+1;
        emit Added(items-1);
        return true;
    }
    
    function idexists(uint num) public view returns (bool) {
        for (uint i = 0; i < rem.length; i++) {
            if (rem[i] == num) {
                return true;
            }
        }
        return false;
    }
    function remitem(uint _productId, string memory _manuname) public view returns (bool){
        require(_productId<=items);
        if(idexists(_productId)==false && allProducts[_productId].manuname==_manuname){
            rem[remcnt]=allProducts[i].productId;
            return true;
        }
        else{
            return false;
        }

    }

    function addState(uint _productId, string memory info) public returns (string memory) {
        require(_productId<=items);
        allProducts[_productId].avail= "Out of Stock";
        State memory newState = State({person: msg.sender, description: info});
        
        allProducts[_productId].positions[ allProducts[_productId].totalStates ]=newState;
        
        allProducts[_productId].totalStates = allProducts[_productId].totalStates +1;
        return info;
    }
    function displayprods() public returns (string[][] memory) {
        string[][] memory a = new string[][](items);
        for(uint i=0;i<items;i++){ 
            string[] memory b = new string[](11);     
            b[0]=uint2str(allProducts[i].productId);
            b[1]=allProducts[i].prodgrd;
            b[2]=allProducts[i].prodtype;
            b[3]=allProducts[i].prodlife;
            b[4]=allProducts[i].packsize;
            b[5]=allProducts[i].prodqnt;
            b[6]=allProducts[i].manuname;
            b[7]=allProducts[i].date;
            b[8]=allProducts[i].avail;
            b[9]=allProducts[i].cntno;
            b[10]=allProducts[i].productName;
            a[i]=b;
        }
        return a;
    }
    function searchProduct(uint _productId) public returns (string memory) {
        require(_productId<=items);
        string memory output="Product Name: ";
        output=concat(output, allProducts[_productId].productName);
        output=concat(output, "<br>Grade: ");
        output=concat(output, allProducts[_productId].prodgrd);
        output=concat(output, "<br>Type: ");
        output=concat(output, allProducts[_productId].prodtype);
        output=concat(output, "<br>Shelf life (in months): ");
        output=concat(output, allProducts[_productId].prodlife);
        output=concat(output, "<br>Packaging Size (in kgs): ");
        output=concat(output, allProducts[_productId].packsize);
        output=concat(output, "<br>Quantity (in kgs): ");
        output=concat(output, allProducts[_productId].prodqnt);
        output=concat(output, "<br>Manufacture Name: ");
        output=concat(output, allProducts[_productId].manuname);
        output=concat(output, "<br>Manufacture Date: ");
        output=concat(output, allProducts[_productId].date);
        
        for (uint256 j=0; j<allProducts[_productId].totalStates; j++){
            output=concat(output, allProducts[_productId].positions[j].description);
        }
        return output;
        
    }
    
}