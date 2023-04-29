//primer kode za izdelavo novega bloka
Blockly.Blocks["string_length"] = {
  init: function () {
    this.appendValueInput("VALUE").setCheck("String").appendField("length of");
    this.setOutput(true, "Number");
    this.setColour(160);
    this.setTooltip("Returns number of letters in the provided text.");
    this.setHelpUrl("http://www.w3schools.com/jsref/jsref_length_string.asp");
  },
};
//primer za izdelavo generatorja kode iz bloka
Blockly.JavaScript["text_length"] = function (block) {
  // String or array length.
  var argument0 =
    Blockly.JavaScript.valueToCode(
      block,
      "VALUE",
      Blockly.JavaScript.ORDER_FUNCTION_CALL
    ) || "''";
  return [argument0 + ".length", Blockly.JavaScript.ORDER_MEMBER];
};

Blockly.Blocks["doberdan"] = {
  init: function () {
    this.appendValueInput("VALUE")
      .setCheck("Number")
      .appendField("print dan x-krat ");
    this.setInputsInline(true);
    this.setColour(360);
    this.setTooltip("");
    this.setHelpUrl("");
  },
};

Blockly.JavaScript["doberdan"] = function (block) {
  // Print statement.
  var msg =
    Blockly.JavaScript.valueToCode(
      block,
      "VALUE",
      Blockly.JavaScript.ORDER_NONE
    ) || "''";
  return 'window.alert("dan".repeat(' + msg + "));";
};

Blockly.Blocks["obrniDesno"] = {
  init: function () {
    this.appendDummyInput().appendField("obrni desno");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour("#ff4136"); //"#ff4136"
    this.setTooltip("obrni za 90 stopinj v desno");
    this.setHelpUrl("");
  },
};

Blockly.JavaScript["obrniDesno"] = function (block) {
  var code = "obrniDesno();\n";
  return code;
};

Blockly.Blocks["obrniLevo"] = {
  init: function () {
    this.appendDummyInput().appendField("obrni levo");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour("#ff4136"); //"#ff4136"
    this.setTooltip("obrni za 90 stopinj v levo");
    this.setHelpUrl("");
  },
};

Blockly.JavaScript["obrniLevo"] = function (block) {
  var code = "obrniLevo();\n";
  return code;
};

Blockly.Blocks["premikNaprej"] = {
  init: function () {
    this.appendDummyInput().appendField("premakni naprej");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour("#ff4136"); //"#ff4136"
    this.setTooltip("premakni za eno polje naprej");
    this.setHelpUrl("");
  },
};

Blockly.JavaScript["premikNaprej"] = function (block) {
  var code = "premikNaprej();\n";

  return code;
};

Blockly.Blocks["dosegelKonecPoti"] = {
  init: function () {
    this.appendDummyInput().appendField("konec poti");
    this.setOutput(true, "Boolean");
    this.setColour("#ff4136"); //"#ff4136"
    this.setTooltip("preveri, če je dosegel konec poti");
    this.setHelpUrl("");
  },
};

Blockly.JavaScript["dosegelKonecPoti"] = function (block) {
  return ["dosegelKonecPoti()", Blockly.JavaScript.ORDER_ATOMIC];
};
