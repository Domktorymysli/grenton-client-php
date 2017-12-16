local function simple_client()

    DOM->x200003152_DOUT3->Switch(0)
    temperatureSensorOne = DOM->x113247182_ONEW_SENSOR1->Value
    temperatureSensorTwo = DOM->x154160907_ONEW_SENSOR1->Value

    return "{\"t1\":" .. temperatureSensorOne .. ",\"t2\":" .. temperatureSensorTwo .. "}"
end
