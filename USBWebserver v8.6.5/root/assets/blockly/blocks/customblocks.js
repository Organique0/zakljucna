  //primer kode za izdelavo novega bloka
  Blockly.Blocks['string_length'] = {
    init: function() {
      this.appendValueInput('VALUE')
          .setCheck('String')
          .appendField('length of');
      this.setOutput(true, 'Number');
      this.setColour(160);
      this.setTooltip('Returns number of letters in the provided text.');
      this.setHelpUrl('http://www.w3schools.com/jsref/jsref_length_string.asp');
    }
  };
  //primer za izdelavo generatorja kode iz bloka
  Blockly.JavaScript['text_length'] = function(block) {
    // String or array length.
    var argument0 = Blockly.JavaScript.valueToCode(block, 'VALUE',
        Blockly.JavaScript.ORDER_FUNCTION_CALL) || '\'\'';
    return [argument0 + '.length', Blockly.JavaScript.ORDER_MEMBER];
  };

  Blockly.Blocks['doberdan'] = {
    init: function() {
      this.appendValueInput("VALUE")
          .setCheck("Number")
          .appendField("print dan x-krat ");
      this.setInputsInline(true);
      this.setColour(360);
   this.setTooltip("");
   this.setHelpUrl("");
    }
  };

  Blockly.JavaScript['doberdan'] = function(block) {
    // Print statement.
    var msg = Blockly.JavaScript.valueToCode(block, 'VALUE',
        Blockly.JavaScript.ORDER_NONE) || '\'\'';
    return 'window.alert("dan".repeat('+msg+'));';
  };


  Blockly.Blocks['obrniDesno'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("obrni desno");
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour("#ff4136");//"#ff4136"
   this.setTooltip("obrni za 90 stopinj v desno");
   this.setHelpUrl("");
    }
  };

  Blockly.JavaScript['obrniDesno'] = function(block) {
    var code = 'obrniDesno();\n';
    return code;
  };

  Blockly.Blocks['obrniLevo'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("obrni levo");
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour("#ff4136");//"#ff4136"
   this.setTooltip("obrni za 90 stopinj v levo");
   this.setHelpUrl("");
    }
  };

  Blockly.JavaScript['obrniLevo'] = function(block) {
    var code = 'obrniLevo();\n';
    return code;
  };

  Blockly.Blocks['premikNaprej'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("premakni naprej");
      this.setPreviousStatement(true, null);
      this.setNextStatement(true, null);
      this.setColour("#ff4136");//"#ff4136"
   this.setTooltip("premakni za eno polje naprej");
   this.setHelpUrl("");
    }
  };
    
  Blockly.JavaScript['premikNaprej'] = function(block) {
    var code = 'premikNaprej();\n';
    
    return code;
  };

  Blockly.Blocks['dosegelKonecPoti'] = {
    init: function() {
      this.appendDummyInput()
          .appendField("konec poti");
      this.setOutput(true, 'Boolean');
      this.setColour("#ff4136");//"#ff4136"
      this.setTooltip("preveri, če je dosegel konec poti");
      this.setHelpUrl("");
    }
  };
    
  Blockly.JavaScript['dosegelKonecPoti'] = function(block) {
    return ['dosegelKonecPoti()', Blockly.JavaScript.ORDER_ATOMIC];
  };
  
  Blockly.defineBlocksWithJsonArray([{
    "type": "controls_if",
    "message0": "%{BKY_CONTROLS_IF_MSG_IF} %1",
    "args0": [
      {
        "type": "input_value",
        "name": "IF0",
        "check": "Boolean"
      }
    ],
    "message1": "%{BKY_CONTROLS_IF_MSG_THEN} %1",
    "args1": [
      {
        "type": "input_statement",
        "name": "DO0"
      }
    ],
    "previousStatement": null,
    "nextStatement": null,
    "colour": "#158cba",
    "helpUrl": "%{BKY_CONTROLS_IF_HELPURL}",
    "mutator": "controls_if_mutator",
    "extensions": ["controls_if_tooltip"]
  },
  {
    "type": "logic_negate",
    "message0": "%{BKY_LOGIC_NEGATE_TITLE}",
    "args0": [
      {
        "type": "input_value",
        "name": "BOOL",
        "check": "Boolean"
      }
    ],
    "output": "Boolean",
    "colour": "#158cba",
    "tooltip": "%{BKY_LOGIC_NEGATE_TOOLTIP}",
    "helpUrl": "%{BKY_LOGIC_NEGATE_HELPURL}"
  },{
    "type": "logic_boolean",
    "message0": "%1",
    "args0": [
      {
        "type": "field_dropdown",
        "name": "BOOL",
        "options": [
          ["%{BKY_LOGIC_BOOLEAN_TRUE}", "TRUE"],
          ["%{BKY_LOGIC_BOOLEAN_FALSE}", "FALSE"]
        ]
      }
    ],
    "output": "Boolean",
    "colour": "#158cba",
    "tooltip": "%{BKY_LOGIC_BOOLEAN_TOOLTIP}",
    "helpUrl": "%{BKY_LOGIC_BOOLEAN_HELPURL}"
  },{
    "type": "controls_repeat_ext",
    "message0": "%{BKY_CONTROLS_REPEAT_TITLE}",
    "args0": [{
      "type": "input_value",
      "name": "TIMES",
      "check": "Number"
    }],
    "message1": "%{BKY_CONTROLS_REPEAT_INPUT_DO} %1",
    "args1": [{
      "type": "input_statement",
      "name": "DO"
    }],
    "previousStatement": null,
    "nextStatement": null,
    "colour": "#28b62c",
    "tooltip": "%{BKY_CONTROLS_REPEAT_TOOLTIP}",
    "helpUrl": "%{BKY_CONTROLS_REPEAT_HELPURL}"
  },{
    "type": "controls_whileUntil",
    "message0": "%1 %2",
    "args0": [
      {
        "type": "field_dropdown",
        "name": "MODE",
        "options": [
          ["%{BKY_CONTROLS_WHILEUNTIL_OPERATOR_WHILE}", "WHILE"],
          ["%{BKY_CONTROLS_WHILEUNTIL_OPERATOR_UNTIL}", "UNTIL"]
        ]
      },
      {
        "type": "input_value",
        "name": "BOOL",
        "check": "Boolean"
      }
    ],
    "message1": "%{BKY_CONTROLS_REPEAT_INPUT_DO} %1",
    "args1": [{
      "type": "input_statement",
      "name": "DO"
    }],
    "previousStatement": null,
    "nextStatement": null,
    "colour": "#28b62c",
    "helpUrl": "%{BKY_CONTROLS_WHILEUNTIL_HELPURL}",
    "extensions": ["controls_whileUntil_tooltip"]
  },{
    "type": "controls_flow_statements",
    "message0": "%1",
    "args0": [{
      "type": "field_dropdown",
      "name": "FLOW",
      "options": [
        ["%{BKY_CONTROLS_FLOW_STATEMENTS_OPERATOR_BREAK}", "BREAK"],
        ["%{BKY_CONTROLS_FLOW_STATEMENTS_OPERATOR_CONTINUE}", "CONTINUE"]
      ]
    }],
    "previousStatement": null,
    "colour": "#28b62c",
    "helpUrl": "%{BKY_CONTROLS_FLOW_STATEMENTS_HELPURL}",
    "extensions": [
      "controls_flow_tooltip",
      "controls_flow_in_loop_check"
    ]
  },{
    "type": "logic_null",
    "message0": "%{BKY_LOGIC_NULL}",
    "output": "null",
    "colour": "#158cba",
    "tooltip": "%{BKY_LOGIC_NULL_TOOLTIP}",
    "helpUrl": "%{BKY_LOGIC_NULL_HELPURL}"
  },
]);  // END JSON EXTRACT (Do not delete this comment.)])






